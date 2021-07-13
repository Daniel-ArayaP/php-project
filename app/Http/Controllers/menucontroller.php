<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuController
{

    const
        ADMIN_MENU          = 1,
        USER_MENU           = 2,
        COMP_MENU           = 3, //COMPANY
        INST_MENU           = 4,
        USERN_ADMIN_MENU    = 5, // USER AND ADMIN
        ALL_MENU            = 6,
        SE_MENU             = 7 // SERVICIOS ESTUDIANTILES aca vamos a echar un ojo

    ;

    public static $mainMenu, $subMenu;

    public static function init()
    {
        self::$mainMenu = [
            // nombre del menu, quien puede acceder al menu, null = dropdown ?? route,fontawesome, clase.
    /*00*/    ["Menu Principal-Modulos",                  self::ALL_MENU,   "webPage", /*  Auth::user()->getIndexPage(), */          "fa-home","always_active"],
    /*01*/    ["Modulo de TCU, PES & TFG",                self::USERN_ADMIN_MENU,     NULL,                         "fa-user-graduate",           NULL],
    /*02*/    ["Modulo de Empresas",                      self::USERN_ADMIN_MENU,     NULL,                              "fa-building",           NULL],
    /*03*/    ["Modulo de Docentes",                      self::ADMIN_MENU,     NULL,                    "fa-chalkboard-teacher",           NULL],
    /*04*/    ["Modulo de Convalidaciones",               self::ALL_MENU,   NULL,                        "fa-file-signature",           NULL],

            /*05*/    ["Modulo Investigacion & Ext.",    self::USERN_ADMIN_MENU,     "mostrarProyecto",              "fas fa-glasses",           NULL],
            /*06*/    ["Modulo de Levant. Req.",                  self::USERN_ADMIN_MENU,     NULL,                           "fa-user-secret",           NULL],

            /*07*/    ["Modulo de Cursos Libres",           self::ALL_MENU,     NULL,                          "fas fa-file-pdf",           NULL],

            /*08*/    ["Usuarios",                      self::ADMIN_MENU,     "adminUsers",                   "fa-fingerprint",    "has_title"],
            /*09*/    ["Servicios Estudiantiles",       self::ADMIN_MENU,     "registerUsers",                "fa-fingerprint",           NULL],
            /*10*/    ["Administrativos",               self::ADMIN_MENU,     "horarioIndex",                    "fa-user-tie",           NULL],

            /*11*/    ["Plan de Estudios",              self::ADMIN_MENU,      NULL,                           "fa-university",           NULL],
            /*12*/    ["Levantamiento Requerimientos",                     self::ALL_MENU,      NULL,                          "fa-user-secret",           NULL],

            /*13*/    ["Proyectos",                      self::COMP_MENU,      NULL,                          "fa-folder-plus",           NULL],

            /*14*/    ["Cursos",                             self::USERN_ADMIN_MENU,      NULL,                               "fa-trophy",           NULL],

            /*15*/    ["---!Créditos del sistema!",                        self::ALL_MENU,      "creditos",                         "fa-trophy",           NULL],

            /*16*/    ["Consultar plan 2020 .",           self::ADMIN_MENU, "consultar-plan-get",              "fa-search",           NULL],
            /*16*/    ["Modulo Pagos Pendientes",           self::ADMIN_MENU, "consultar-plan-get",              "fa-user-tie",           NULL],

        ];


        self::$subMenu = [
            //nombre submenu, ruta, quien puede acceder, numero del menu al que pertenece.
            ["Info. General",                "studentHome",                       self::USERN_ADMIN_MENU,              01],
            ["Propuestas",                       "project",                       self::USERN_ADMIN_MENU,       01],
            ["Periodos",                         "periods",                       self::ADMIN_MENU,             01],
            ["Oportunidades",               "oportunities",                       self::USERN_ADMIN_MENU,       01],
            ["Horarios (TCU)",                 "schedules",                       self::ADMIN_MENU,       01],
            ["Tutores",                           "tutors",                       self::USERN_ADMIN_MENU,             01],
            ["Rep. Académicos",      "acadRepresentatives",                       self::ADMIN_MENU,             01],
            ["Estudiantes",                    "adminHome",                       self::ADMIN_MENU,             01],
            ["Defensas",                    "defensesList",                       self::USERN_ADMIN_MENU,       01],
            ["Reportes",                  "studentsReport",                       self::ADMIN_MENU,       01],
            ["PES  y TFG Empresas",     "companiesReportStudents",                self::ADMIN_MENU,              01],
            ["Mis calificaciones",     "project",                self::USERN_ADMIN_MENU,              01],

            ["Empresas Inscritas",        "adminCompanies",                        self::ADMIN_MENU,            02],
            ["Proyectos REA",            "adminProjects",                          self::ADMIN_MENU,            02],
            ["Estudiantes Aprobados","ApprovedStudentsReport",                     self::ADMIN_MENU,            02],
            ["Oportunidades PES y TFG",     "companiesReportStudents",             self::USER_MENU,             02],
            ["Solicitud Participación",  "solicitudesreportstudents",              self::USER_MENU,             02],
            ["Mis Proyectos PES", "participantesreportstudents",                   self::USER_MENU,             02],

            ["Listado",                    "profesorIndex",                       self::ADMIN_MENU,             03],
            ["Cursos",                        "cursoIndex",                       self::ADMIN_MENU,             03],
            ["Eval. temprana",             "encuestaIndex",                       self::ADMIN_MENU,             03],

            ["Listado",             "indexConvalidaciones",                       self::ALL_MENU,             04],
            ["Nueva Pre Conv.",     "iniciarConvalidacion",                       self::ALL_MENU,             04],
            ["Registrar Carrera.",                "import",                       self::ALL_MENU,             04],
            ["Listado Materias",                 "verView",                       self::ALL_MENU,             04],
            ["Anál. Periodo",            "analisisPeriodo",                       self::ALL_MENU,             04],
            ["Anál. Carrera",            "analisisCarrera",                       self::USERN_ADMIN_MENU,             04],
            ["Anál. Instituto",        "analisisInstituto",                       self::USERN_ADMIN_MENU,             04],
            ["Buscar Convalidaciones", "verView",              self::USERN_ADMIN_MENU,             04],



            ["Ver plan",                     "consulta_Ad",                       self::USERN_ADMIN_MENU,             06],
            ["Mis solicitudes",           "consultarAdmin",                       self::USERN_ADMIN_MENU,             06],
            ["Mis Calificaciones",           "consultarAdmin",                       self::USERN_ADMIN_MENU,             06],
            ["Ver Estado Actual",           "consultarAdmin",                       self::USERN_ADMIN_MENU,             06],
            ["Cambiar Materias",           "consultarAdmin",                       self::USERN_ADMIN_MENU,             06],
            ["Retirar Materias",           "consultarAdmin",                       self::USERN_ADMIN_MENU,             06],


            ["Gestión",                    "adminTraining",                       self::ADMIN_MENU,             07],
            ["Proponer un curso",        "trainingCreateView",                    self::ALL_MENU,             07],
            ["Cursos",                    "trainingList",                         self::USERN_ADMIN_MENU,             07],
            ["Mis postulacionesss",         "myApplications",                     self::USERN_ADMIN_MENU,             07],
            ["Hoja de vida",                        "myCv",                       self::USERN_ADMIN_MENU,             07],
            ["Matrícula",            "trainingMatriculate",                       self::USERN_ADMIN_MENU,             07],
            ["Mis cursos",         "matriculateCourseList",                       self::ALL_MENU,             07],

            ["Chats",                "adminHome",                       self::USERN_ADMIN_MENU,             07],
            ["Reportería",                 "coursesReport",                       self::ADMIN_MENU,             07],

            ["Crear plan",                  "create_plans",                       self::ADMIN_MENU,             11],
            ["Editar plan",                   "edit_plans",                       self::ADMIN_MENU,             11],
            ["Eliminar plan",            "eliminate_plans",                       self::ADMIN_MENU,             11],

            ["Ver planes",                     "consultar",                     self::ALL_MENU,             12],
            ["Solicitar",    "crearSolicitudLevantamiento",                     self::ALL_MENU,             12],
            ["Mis Solicitudes",           "misSolicitudes",                     self::ALL_MENU,             12],
            ["Retiro de Materias",           "verView",                     self::ALL_MENU,             12],
            ["Cambio de materias",           "verView",                     self::ALL_MENU,             12],


            ["Proyectos presentados",    "projectsCompany",                        self::COMP_MENU,             13],
            ["Crear proyecto nuevo",     "createCompanyProject",                   self::COMP_MENU,             13],
            ["Crear Oportunidad",      "createOportunities",                       self::COMP_MENU,             13],
            ["Solicitudes por aprobar",  "listCompanyPendingApprovals",            self::COMP_MENU,             13],

            ["Todos",                            "courses", self::USERN_ADMIN_MENU << self::INST_MENU,             14],
            ["Mis cursos",                    "my_courses", self::USERN_ADMIN_MENU << self::INST_MENU,             14],
            ["Progreso", "proceso_curso_estudiante_universidad",                      self::USER_MENU,             14],


        ];
    }

    public static function createMenu()
    {
        self::init();
        $html5 = "";

        foreach (self::$mainMenu as $i => $menu) {
            if (
                Auth::user()->role_id == 1 && !in_array($menu[1], [1, 5, 6, 128, 80]) ||

                Auth::user()->role_id == 2 && !in_array($menu[1], [2, 5, 6, 80]) ||
                Auth::user()->role_id == 3 && !in_array($menu[1], [3, 6]) ||
                Auth::user()->role_id == 4 && !in_array($menu[1], [4, 6, 80]) ||
                Auth::user()->role_id == 5 && !in_array($menu[1], [6, 7, 128])
            )
                continue;

            if ($menu[4] == "has_title") {
                $html5 .= '<li class="title">Gesti&oacute;n</li>';
            }

            if (!is_null($menu[2]))
                $html5 .= '<li><a class="' . $menu[4] . '"  href="' . route($menu[2]) . '"><i class="fas ' . $menu[3] . '"></i> ' . $menu[0] . '</a></li>';
            else {
                $html5 .=  '
                    <li><a class="' . (!is_null($menu[4] ? $menu[4] : '')) . '" ><i class="fas ' . $menu[3] . '"></i>' . $menu[0] . ' <i class="fas fa-angle-right cart light"></i></a>
                        <ul class="subUL">
                ';

                foreach (self::$subMenu as $j => $submenu) {
                    if ($submenu[3] != $i)
                        continue;



                    if (
                        Auth::user()->role_id == 1 && !in_array($submenu[2], [1, 5, 6, 128, 80]) ||
                        Auth::user()->role_id == 2 && !in_array($submenu[2], [2, 5, 6, 80]) ||
                        Auth::user()->role_id == 3 && !in_array($submenu[2], [3, 6]) ||
                        Auth::user()->role_id == 4 && !in_array($submenu[2], [4, 6, 80]) ||
                        Auth::user()->role_id == 5 && !in_array($submenu[2], [6, 7, 128])
                    )
                        continue;

                    $html5 .= "<li><a href='" . route($submenu[1]) . "' aria-submenu='" . $submenu[3] . "'> <i class='fas fa-angle-right'></i>" . $submenu[0] . "</a></li>";
                }

                $html5 .= '</ul>';
            }
        }

        $html5 .= '</ul>';
        return $html5;
    }
}
