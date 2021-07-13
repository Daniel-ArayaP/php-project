<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\CarreraUlatina;
use App\Models\PlanEstudios;
use App\Models\Sede;
use App\Models\Period;
use App\Models\Levantamiento;
use App\Models\LevantamientoIndividual;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\ContenidoCarrera;
use Carbon\Carbon;
use Auth;
use Mail;
use DB;

class LevantamientoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        //TODO: Reemplazar con datos reales
        $career = $this->getDummyCareer();
        $sede = Sede::where('id_sedes', '2')->first();
        $period = Period::where('active', '1')->first();
        // END
        $levantamiento = Levantamiento::where('id_estudiantes_levantamiento', $id)->first();
        if ($levantamiento && !$levantamiento->revisado_por) {
            return view('levantamiento.crear', [
                'career' => $career,
                'sede' => $sede,
                'period' => $period,
                'levantamiento' => $levantamiento,
            ]);
        } else {
            return back()->with('error', 'No se puede editar esta solicitud.');
        }
    }

    public function enviarARegistro($id)
    {
        $levantamiento = Levantamiento::where('id_estudiantes_levantamiento', $id)->first();
        //EMAIL: Cambiar al correo de Registro
        Mail::to(env('MAIL_USERNAME'))->send(
            new \App\Mail\SolicitudLevantamiento($levantamiento)
        );
        return back()->with('sucess', 'Se envío correctamente el correo.');
    }

    public function getDummyCareer()
    {
        $career = CarreraUlatina::where('id_carreras_ulatina', 'SIS-001')->first();
        return $career;
    }


    /* ----------------Funciones de estudiantes actuales 2019 II cuatri---------------------------------------------------------------- */

    /* obtiene todas las sedes y carreras almacenadas en la base de datos */
    public function consultar_plan_get()
    {
        /* obtiene todas las sedes y carreras almacenadas en la base de datos */
        $lista_sede = Sede::all();
        $lista_carreras = CarreraUlatina::pluck('nombre_carreras_ulatina', 'id_carreras_ulatina');
        /* Envía a la vista los datos */
        return view('levantamiento.student.consulta')
            ->with('lista_sede', $lista_sede)
            ->with('lista_carreras', $lista_carreras);
    }

    public function obtener_plan($id)
    {
        return PlanEstudios::where('id_carreras_ulatina', '=', $id)->get();
    }
    public function ver_planes(Request $request)
    {
        if (empty($request->sede) or empty($request->career) or empty($request->plan)) {
            return back()->with('error', 'Seleccione todos los campos.');
        }
        $sede = Sede::where('id_sedes', $request->sede)->first();
        $carrer = CarreraUlatina::where('id_carreras_ulatina', $request->career)->get();
        $plan = PlanEstudios::where('id_plan_estudios', $request->plan)->get();

        $contenido = ContenidoCarrera::where('id_plan_estudios', '=', $request->plan)
            ->orderBy('indice', 'ASC')
            ->get();
        $requisito = ContenidoCarrera::where('id_contenido_carreras', '=', 'id_contenidos_carrera_pendiente')->get();


        return view('levantamiento.student.ver_planes', compact('sede', 'carrer', 'plan', 'contenido', 'requisito'));
    }
    /* -------------Funciones de registro actuales 2019 II cuatri------------------- */
    public function consultar_plan_Re()
    {
        $sedes = Sede::all();
        $careers = CarreraUlatina::all();

        return view('levantamiento.consulta_Re', compact(
            'sedes',
            'careers'
        ));
    }
    public function obtener_planR($id)
    {
        //revisar este metodo
        return PlanEstudios::where('id_carreras_ulatina', '=', $id)->get();
    }
    public function ver_plan_Re(Request $request)
    {
        if (empty($request->sede) or empty($request->career) or empty($request->plan)) {
            return back()->with('error', 'Seleccione todos los campos.');
        }
        $sede = Sede::where('id_sedes', $request->sede)->first();
        $carrer = CarreraUlatina::where('id_carreras_ulatina', $request->career)->get();
        $plan = PlanEstudios::where('id_plan_estudios', $request->plan)->get();

        $contenido = ContenidoCarrera::where('id_plan_estudios', '=', $request->plan)
            ->orderBy('indice', 'ASC')
            ->get();

        $requisito = ContenidoCarrera::where('id_contenido_carreras', '=', 'id_contenidos_carrera_pendiente')->get();


        return view('levantamiento.ver_plan_Re', compact('sede', 'carrer', 'plan', 'contenido', 'requisito'));
    }
    public function crearSolicitudLevantamiento()
    {
        /* obtiene todas las sedes, carreras y planes almacenadas en la base de datos */
        // $estudiante = Student::all();
        $sedes = Sede::all();
        $careers = CarreraUlatina::all();
        $planes = PlanEstudios::all();

        /* Envía a la vista los datos */
        return view('levantamiento.crear', [
            // 'estudiante' => $estudiante,
            'careers' => $careers,
            'sedes' => $sedes,
            'planes' => $planes,
        ]);
    }
    public function store(Request $request)
    {
        /* Se comprueba que la sede, la carrera existan y el plan*/
        $sede = Sede::where('id_sedes', $request->sede)->first();

        if (empty($sede)) {
            return back()->with('error', 'La sede que seleccionó, no existe en los registros.');
        }
        $career = CarreraUlatina::where('id_carreras_ulatina', $request->career)->first();

        if (empty($career)) {
            return back()->with('error', 'La carrera que seleccionó, no existe en los registros.');
        }

        $plan = PlanEstudios::where('id_plan_estudios', $request->plan)->first();

        if (empty($plan)) {
            return back()->with('error', 'El plan que seleccionó, no existe en los registros.');
        }

        /* se obtienen los cursos que vienen del formulario de la solicitud de levantamiento */
        $courses = json_decode($request->courses);

        /* SE BUSCAN TODOS LOS CURSOS SOLICITADOS: el "whereIn" permite hacer una consulta
         SQL, que recibe como parámetros, el nombre del campo de la tabla que se desea consultar
         y un arreglo de datos, que son las siglas de los cursos en este caso. Devolverá un
         arreglo de los objetos encontrados por la consulta. */
        $founded_courses = ContenidoCarrera::whereIn('id_contenido_carreras', $courses)->get();

        $periods = Period::all();

        /* SE CREA UN ARREGLO CON LOS DATOS OBTENIDOS: este arreglo es para enviarlo
         a la vista*/
        $data = [
            'sede'    => $sede,
            'career'  => $career,
            'plan'    => $plan,
            'courses' => $founded_courses,
            'periods' => $periods

        ];

        /* Por el request, viene una variable que se llama tipo_solicitud, con esta se evalua si el usuario
         de registro decidió ya sea aprobar la solicitud o necesita que la solicitud sea evaluada por la escuela*/
        if ($request->tipo_solicitud == 'cumple-criterio') {
            $data['tipo_solicitud'] = 'cumple';
        } else if ($request->tipo_solicitud == 'mandar-revision') {
            $data['tipo_solicitud'] = 'revision';
        } else {
            /* si ninguna de las dos opciones se cumple, se devolverá un error. */
            return back()->with('error', 'Ha ocurrido un error inesperado. Vuelva a intentar crear la solicitud.');
        }
        /* se llama a la vista con los datos obtenidos mediante las consultas hechas arriba. */
        return view('levantamiento.guardar-solicitud')->with('data', $data);
    }
    /**
     * Permite obtener los requisitos de el curso consultado por ID del curso.
     */
    public function getCorequisites($id)
    {/* se obtiene el curso consultado de la BD por el ID */
        $course = ContenidoCarrera::where('id_contenido_carreras', $id)->first();
        return response()->json([
            'code' => $course->id_contenido_carreras,
            'course' => $course->nombre_contenido_carreras,
            'creditos' => $course->creditos_contenido_carreras,
            'corequisites' => $course->correquisitos,
            'criterio' => $course->sensibilidad

        ]);
    }


    public function getCorequisitesConsulta($id)
    {
        $course = ContenidoCarrera::where('id_contenido_carreras', $id)->first();
        /* arreglo con los datos del curso encontrado, para cargarlos en la tabla
        de los cursos consultados por el estudiante */
        $data = array(
            'id' => $course->id_contenido_carreras,
            'materia' => $course->nombre_contenido_carreras,
            'creditos' => $course->creditos_contenido_carreras,
            'requisitos' => $course->correquisitos,
            'criterio' => $course->sensibilidad
        );
        /* se devuelve el objeto creado con los datos de los requisitos de curso */
        return response()->json($data);
    }

    public function obtener_cursos_plan($id)
    {
        return ContenidoCarrera::where('id_plan_estudios', '=', $id)->get();
    }

    public function guardar_solicitud(Request $request)
    {

        /* Se comprueba que la sede y la carrera existan*/
        $career = CarreraUlatina::where('id_carreras_ulatina', $request->carrera)->first();

        if (empty($career)) {
            return response()->json(['error' => 'No se ha encontrado la carrera.']);
        }
        $sede = Sede::where('id_sedes', $request->sede)->first();

        if (empty($sede)) {
            return response()->json(['error' => 'No se ha encontrado la sede.']);
        }
        $plan = PlanEstudios::where('id_plan_estudios', $request->planes)->first();

        if (empty($plan)) {
            return response()->json(['error' => 'No se ha encontrado el plan.']);
        }
        // TODO: habilitar esta opcion para guardar el admin y guardar el id en la variable -id_admins- de levantamiento
        // /* SE BUSCA EL ID DE ADMIN DEL USUARIO CONECTADO Y SE COMPRUEBA QUE EXISTA, si no existe, se devolvera
        // un error. */
        $admins = Admin::where('user_id', Auth::user()->id)->first();

        if (empty($admins)) {
            return response()->json(['error' => 'No se ha encontrado el usuario admin.']);
        }
        if ($request->tipo_solicitud == 'cumple') {
            /* se hace un bloque try-catch, para que, si ocurre un error al momento de guardar,
            se deshaga toda la operacion, es decir, los datos que hayan sido guardados en la BD
            desaparezcan. */
            try {
                /* se inicia la transaccion SQL */
                DB::beginTransaction();

                /* se crea la solicitud de levantamiento: el metodo 'create' recibe por parametros
                un arreglo con los datos a guardar en dicho objeto. Este arreglo que recibe, tiene
                que tener en la clave el nombre de la variable que le corresponde en la base de datos.
                El valor debera ser lo que se desea guardar. */
                $solicitud = Levantamiento::create([
                    'carne_estudiante' => $request->carnet_estudiante,
                    'nombre_estudiante' => $request->nombre_estudiante,
                    'id_carreras_ulatina' => $request->carrera, /* FK ulatina_carreras(id_carreras_ulatina) */
                    'id_sedes' => $request->sede, /* FK sedes(id_sedes) */
                    'id_admins' => $admins->person_profile_id, /* FK admins(person_profile_id) */
                    'motivo' => null,
                    'fecha_solicitud' => Carbon::now(),
                    'fecha_revisado' => Carbon::now(),
                    'revisado_por' => $admins->getFullNameAttribute(),
                    'fecha_ultimo_cambio' => Carbon::now(),
                    'id_period' => $request->periodo, /* FK periods(id) */
                    'id_plan_estudios' => $request->planes,  /* FK plan_estudios(id_plan_estudios) */
                ]);

                /* se obtienen los cursos que vienen del formulario de la solicitud. */
                $courses = $request->cursos;

                /* se barren los cursos obtenidos, para almacenar la solicitud individual por cada
                curso. Se crean igual que el metodo 'create' mencionado anteriormente. */
                foreach ($courses as $curso) {
                    $solicitudIndividual = LevantamientoIndividual::create([

                        'id_estudiante_levantamiento' => $solicitud->id_estudiantes_levantamiento, /* FK estudiantes_levantamientos(id_estudiantes_levantamiento) */
                        'motivo_estudiante' => $request->motivo,
                        'estado_solicitud_individual' => 'APROBADA',
                        'fecha_ultimo_cambio' => Carbon::now(),
                        'id_contenido_carrera' => $curso, /* FK contenido_carreras(id_contenido_carreras)*/
                    ]);
                }
                /* Si todo esta bien, se procede a hacer un commit en la BD, para que los datos queden almacenados correctamente.*/
                DB::commit();

                return response()->json(['exito' => 'La solicitud ha sido guardada.']);
            }
            /* el bloque catch atrapa todos los errores que ocurran en la ejecucion */ catch (\Exception $error) {
                /* si algún error ocurre, se le hará un rollback a los datos que se hayan insertado */
                DB::rollback();
                /* Se devuelve un arreglo con los datos del error ocurrido, que se imprimira en consola.
                Estos datos son el mensaje de la excepcion atrapada, la linea de código y el archivo que
                generó dicho error */
                return response()->json([
                    'error' => 'No se han podido guardar los datos.',
                    'excepcion' => [
                        'message' => $error->getMessage(),
                        'line' => $error->getLine(),
                        'file' => $error->getFile()
                    ]
                ]);
            }
        } else if ($request->tipo_solicitud == 'revision') {

            try {
                DB::beginTransaction();
                /* se crea la solicitud de levantamiento: el metodo 'create' recibe por parametros
                un arreglo con los datos a guardar en dicho objeto. Este arreglo que recibe, tiene
                que tener en la clave el nombre de la variable que le corresponde en la base de datos.
                El valor debera ser lo que se desea guardar. */
                $solicitud = Levantamiento::create([
                    'carne_estudiante' => $request->carnet_estudiante,
                    'nombre_estudiante' => $request->nombre_estudiante,
                    'id_carreras_ulatina' => $request->carrera, /* FK ulatina_carreras(id_carreras_ulatina) */
                    'id_sedes' => $request->sede, /* FK sedes(id_sedes) */
                    'id_admins' => $admins->person_profile_id, /* FK admins(person_profile_id) */
                    'motivo' => null,
                    'fecha_solicitud' => Carbon::now(),
                    'fecha_revisado' => null,
                    'revisado_por' => null,
                    'fecha_ultimo_cambio' => Carbon::now(),
                    'id_period' => $request->periodo, /* FK periods(id) */
                    'id_plan_estudios' => $request->planes  /* FK plan_estudios(id_plan_estudios) */
                ]);

                /* se obtienen los cursos que vienen del formulario de la solicitud. */
                $courses = $request->cursos;

                /* se barren los cursos obtenidos, para almacenar la solicitud individual por cada
                curso. Se crean igual que el metodo 'create' mencionado anteriormente. */
                foreach ($courses as $curso) {
                    $solicitudIndividual = LevantamientoIndividual::create([
                        'id_estudiante_levantamiento' => $solicitud->id_estudiantes_levantamiento, /* FK estudiantes_levantamientos(id_estudiantes_levantamiento) */
                        'motivo_estudiante' => $request->motivo,
                        'estado_solicitud_individual' => 'PENDIENTE',
                        'fecha_ultimo_cambio' => Carbon::now(),
                        'id_contenido_carrera' => $curso, /* FK contenido_carreras(id_contenido_carreras)*/
                    ]);
                }

                DB::commit();
            } catch (\Exception $error) {
                /* si algún error ocurre, se le hará un rollback a los datos que se hayan insertado */
                DB::rollback();
                /* se devuelve un arreglo con los datos del error ocurrido, que se imprimira en consola.
                Estos datos son el mensaje de la excepcion atrapada, la linea de código y el archivo que
                generó dicho error */
                return response()->json([
                    'error' => 'No se han podido guardar los datos.',
                    'excepcion' => [
                        'message' => $error->getMessage(),
                        'line' => $error->getLine(),
                        'file' => $error->getFile()
                    ]
                ]);
            }
            return response()->json([
                'exito' => 'La solicitud se ha enviado a revisión, por lo que debe esperar que el encargado de la carrera realice el trámite respectivo para aprobar la solicitud.'
            ]);
        } else {
            return response()->json([
                'error' => 'Usted ha intentando romper el sistema.'
            ]);
        }
    }
    public function showConsultarSolicitudes()
    {
        $careers = CarreraUlatina::all();
        $periodos = Period::all();
        $planes = PlanEstudios::all();

        $estados = array(
            'PENDIENTE' => 'PENDIENTE',
            'REVISADA' => 'REVISADA'
        );
        return view('levantamiento.consultar', [
            'careers' => $careers,
            'estados'  => $estados,
            'periodos' => $periodos,
            'planes' => $planes
        ]);
    }

    public function consultarSolicitudes(Request $request)
    {
        $period = Period::where('id', $request->period)->first();

        if (empty($period)) {
            return back()->with('error', 'No existe el período que seleccionó.');
        }
        $levantamientos = null;

        /* se realiza una consulta para obtener todos los levantamientos que cumplan con 
        los criterios de busqueda realizados */
        if (!isset($request->carnet)) {
            // hacer la consulta SIN el carnet del estudiante
            if ($request->status == 'PENDIENTE') {
                $levantamientos = Levantamiento::where(
                    'id_period',
                    $period->id
                )->whereNull(
                    'revisado_por'
                )->get();
            }

            if ($request->status == 'REVISADA') {
                $levantamientos = Levantamiento::where(
                    'id_period',
                    $period->id
                )->whereNotNull(
                    'revisado_por'
                )->get();
            }
        } else {
            // hacer la consulta CON el carnet del estudiante
            if ($request->status == 'PENDIENTE') {
                $levantamientos = Levantamiento::where(
                    'id_period',
                    $period->id
                )->where(
                    'carne_estudiante',
                    $request->carnet
                )->whereNull(
                    'revisado_por'
                )->get();
            }

            if ($request->status == 'REVISADA') {
                $levantamientos = Levantamiento::where(
                    'id_period',
                    $period->id
                )->where(
                    'carne_estudiante',
                    $request->carnet
                )->whereNotNull(
                    'revisado_por'
                )->get();
            }
        }
        if (!isset($request->status)) {
            return back()->with('error', 'No existe el estado que seleccionó.');
        }

        if (sizeof($levantamientos) <= 0) {
            return back()->with('error', 'No hay solicitudes del estudiante, creadas en el periodo y estado seleccionado.');
        }

        return view('levantamiento.solicitudes', [
            'period' => $period,
            'levantamientos' => $levantamientos
        ]);
    }
    /** permite ver el detalle de las solicitudes de levantamiento, cada curso y su estado */
    public function mostrarSolicitudDetalles($id)
    {
        $levantamiento = Levantamiento::where('id_estudiantes_levantamiento', $id)->first();

        return view('levantamiento.ver-detalle-solicitudes', compact('levantamiento'));
    }

    /* --------------Funciones de admin actuales 2019 II cuatri---------------------------------------------------------------------------- */

    public function consulta_Ad(Request $request)
    {
        $sedes = Sede::all();
        $careers = CarreraUlatina::all();
        $planEstudios = PlanEstudios::all();

        return view('levantamiento.admin.consulta_Ad', compact(
            'sedes',
            'careers','planEstudios'
        ));
    }
    public function obtener_planA($id)
    {
        return PlanEstudios::where('id_carreras_ulatina', '=', $id)->get();
    }
    public function ver_plan_Ad(Request $request)
    {
        if (empty($request->sede) or empty($request->career) or empty($request->plan)) {
            return back()->with('error', 'Seleccione todos los campos.');
        }
        $sede = Sede::where('id_sedes', $request->sede)->first();
        $carrer = CarreraUlatina::where('id_carreras_ulatina', $request->career)->get();
        $plan = PlanEstudios::where('id_plan_estudios', $request->plan)->get();

        $contenido = ContenidoCarrera::where('id_plan_estudios', '=', $request->plan)
            ->orderBy('indice', 'ASC')
            ->get();
        $requisito = ContenidoCarrera::where('id_contenido_carreras', '=', 'id_contenidos_carrera_pendiente')->get();
        return view('levantamiento.admin.ver_plan_Ad', compact('sede', 'carrer', 'plan', 'contenido', 'requisito'));
    }


    public function solicitudesAdmin()
    {
        $periods = Period::all();
        $careers = CarreraUlatina::all();
        $sedes = Sede::all();
        $planes = PlanEstudios::all();
        return view('levantamiento.admin.consultar', [
            'careers' => $careers,
            'planes' => $planes,
            'sedes' => $sedes,
            'periods' => $periods
        ]);
    }
    public function postSolicitudesAdmin(Request $request)
    {
        /* se comprueba que se seleccionó una sede */
        if (!isset($request->sede)) {
            return back()->with('error', 'Debe seleccionar una sede.');
        }
        /* SE COMPRUEBA QUE LA SEDE EXISTA EN LA BD */
        $sede = Sede::where('id_sedes', $request->sede)->first();
        if (empty($sede)) {
            return back()->with('error', 'La sede que seleccionó no existe.');
        }
        /* se comprueba que se seleccionó una carrera */
        if (!isset($request->career)) {
            return back()->with('error', 'Debe seleccionar una carrera.');
        }
        /* SE COMPRUEBA QUE LA CARRERA EXISTA EN LA BD */
        $career = CarreraUlatina::where('id_carreras_ulatina', $request->career)->first();
        if (empty($career)) {
            return back()->with('error', 'La carrera que seleccionó no existe.');
        }

        /* se comprueba que se seleccionó un período */
        if (!isset($request->period)) {
            return back()->with('error', 'Debe seleccionar un período.');
        }
        /* SE COMPRUEBA QUE EL PERIODO EXISTA EN LA BD */
        $period = Period::where('id', $request->period)->first();
        if (empty($period)) {
            return back()->with('error', 'El período que seleccionó no existe.');
        }

        $levantamientos = null;

        /* se comprueba que se ingresó un carnet de estudiante, dependiendo de ese dato, asi se
        realiza la consulta */
        if (!isset($request->carnet_estudiante)) {
            $levantamientos = Levantamiento::where(
                'id_sedes',
                $request->sede
            )->where(
                'id_carreras_ulatina',
                $request->career
            )->where(
                'id_period',
                $request->period
            )->get();
        } else {
            $levantamientos = Levantamiento::where(
                'id_sedes',
                $request->sede
            )->where(
                'id_carreras_ulatina',
                $request->career
            )->where(
                'id_period',
                $request->period
            )->where(
                'carne_estudiante',
                $request->carnet_estudiante
            )->get();
        }

        if (sizeof($levantamientos) <= 0) {
            return back()->with('error', 'No hay resultados para su búsqueda.');
        }
        /* se mandan los datos a la vista */
        return view('levantamiento.admin.solicitudes', [
            'solicitudes' => $levantamientos,
            'sede' => $sede,
            'career' => $career,
            'period' => $period,
        ]);
    }

    public function showSolicitudIndividual($id)
    {
        $levantamiento = Levantamiento::where('id_estudiantes_levantamiento', $id)->first();

        if (empty($levantamiento)) {
            return back()->with('error', 'No se ha encontrado la solicitud consultada.');
        }

        /* Si la solicitud ya ha sido revisada, solo se muestra la info, de lo contrario se puede editar */
        $url = 'levantamiento.admin.edit';

        if ($levantamiento->revisado_por) {
            $url = 'levantamiento.admin.show';
        }
        return view($url, [
            'levantamiento' => $levantamiento,
        ]);
    }
    public function updateSolicitud(Request $request, $id)
    {
        $levantamiento = Levantamiento::where('id_estudiantes_levantamiento', $id)->first();
        if ($levantamiento) {
            $admin = Admin::where('user_id', Auth::user()->id)->first();
            $motivo = $request->input('motivo');
            $courses = $request->input('course');
            $states = $request->input('courseApproved');
            for ($i = 0; $i < sizeOf($courses); $i++) {
                $course = $courses[$i];
                $state = $states[$i];
                $courseDB = $levantamiento->courses->where('id_contenido_carrera', $course)->first();
                $courseDB->estado_solicitud_individual = $state;
                $courseDB->fecha_ultimo_cambio = Carbon::now();
                $courseDB->save();
            }
            $levantamiento->id_admins = $admin->person_profile_id;
            $levantamiento->motivo = $motivo;
            $levantamiento->fecha_revisado = Carbon::now();
            $levantamiento->revisado_por = $admin->getFullNameAttribute();
            $levantamiento->fecha_ultimo_cambio = Carbon::now();
            $levantamiento->save();
            return back()->with('sucess', 'Se guardaron correctamente los cambios')->with('estado', 'Solicitud lista');
        } else {
            return back()->with('error', 'Ocurrió un error.');
        }
    }
    /* --------------Funciones de admin para planes de estudios actuales 2019 II cuatri------------------- */
    public function showPlanEstudios()
    {
        $plans = PlanEstudios::all();
        return view('levantamiento.admin.plan', [
            'plans' => $plans,
        ]);
    }

    /* codigo del anterior compañero sin resultados comprovados no utilizados en el cuatri II 2019
    public function getPlanEstudios($id)
    {
        $plan = PlanEstudios::where('id_plan_estudios', $id)->firstOrFail();
        return $plan;
    }

    public function getPlanEstudio(Request $request)
    {
        $id = $request->input('id');
        $plan = PlanEstudios::where('id_plan_estudios', $id)->firstOrFail();
        return $plan->courses->toJson();
    }

    public function getLastUpdatePlan(Request $request)
    {
        $id = $request->input('id');
        $plan = PlanEstudios::where('id_plan_estudios', $id)->firstOrFail();
        return $plan->toJson();
    }

    public function editPlanEstudios($id)
    {
        $plan = PlanEstudios::where('id_plan_estudios', $id)->firstOrFail();
        $coursesInPlan = $plan->courses->pluck('id_contenido_carrera');
        $courses = ContenidoCarrera::whereNotIn('id_contenido_carreras', $coursesInPlan)->get();
        return view('levantamiento.admin.editPlan', [
            'plan' => $plan,
            'courses' => $courses,
        ]);
    }*/

    public function create_plans()
    {
        $careers = CarreraUlatina::all();

        return view('levantamiento.plan.create_plans', compact('careers'));
    }

    public function crearPlan(Request $request)
    {
        if (empty($request->car) or empty($request->plan)) {
            return back()->with('error', 'Ingrese los datos respectivos.');
        } else {
            $NuevoPlan = new PlanEstudios();

            $NuevoPlan->id_carreras_ulatina = $request->car;
            $NuevoPlan->nombre_plan = $request->plan;
            $NuevoPlan->save();
        }
        $carrera = CarreraUlatina::where('id_carreras_ulatina', '=',$request->car)->get();
        $plan = PlanEstudios::where('nombre_plan', '=', $request->plan)->get();
        
        return view('levantamiento.plan.create_planes', compact('carrera', 'plan'));
    }

    public function edit_plans()
    {   
        $career = CarreraUlatina::all();
        $plan = PlanEstudios::all();
        $editContenido = ContenidoCarrera::all();

        return view('levantamiento.plan.edit_plans', compact('editContenido','career','plan'));
    }

    public function obtener_planes($id)
    {
        return PlanEstudios::where('id_carreras_ulatina', '=', $id)->get();
    }
    public function eliminate_plans(Request $request)
    { 
        $plan = PlanEstudios::all();
        return view('levantamiento.plan.eliminate_plans', compact('plan'));
    }
    public function destroy(Request $request)
    { 
        $plan = PlanEstudios::where('nombre_plan', '=', $request->plan);
        $plan->delete();
        return back()->with('sucess', 'Se elimino corectamente.');
    }
}
