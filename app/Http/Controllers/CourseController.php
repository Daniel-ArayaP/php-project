<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Course;
use App\BL\CourseBL;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\CreateCourseSchedule;
use App\Http\Requests\CreateCourseTheme;
use App\Http\Requests\CreateCourseInsTable;
use App\Http\Requests\CreateCourseUniTable;
use App\Http\Requests\CreateCourseComments;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $cursos;
        $schedule = \DB::table("schedule")->get();
        $status = self::static_status_for_courses();

        if ($request['name'] == "")
        {
          if(\Auth::user()->role_id == 1)
          {
            $cursos = DB::table("cursos")->get();
          }elseif (\Auth::user()->role_id == 4)
          {
            $cursos = DB::table("cursos")->where([
              ['status_id','=', 1],
              ['solicitado_por', '=', null]
            ])->orWhere([
              ['creado_por','=', \Auth::user()->id]
              ])->get();
          }
          elseif (\Auth::user()->role_id == 2)
          {
            $cursos = DB::table("cursos")->where([
              ['status_id','=', 13],
              ['profesores_id_profesores', '=', null]
            ])->get();
          }
        }

        else {
            $result = CourseBL::searchCourses($request->all());
            $cursos = $result->get();

            if($cursos->items() == null){
                return redirect()->route('courses')->with('error', 'El nombre indicado no existe');
            }

            else{
                $cursos->appends([
                    'nombre_cursos' => ($request->name == null?'':$request->name)
                    ]);
            }
            $request->flash();
        }
        $profesores = \DB::table('profesores')->get();

        return view('course.todos.index', [
            "cursos" => $cursos,
            "profesores" => $profesores,
            "schedule" => $schedule,
            'status' => $status
        ]);
    }
    public function index_my_courses(Request $request)
    {

        $cursos=null;
        $schedule = \DB::table("schedule")->get();
        $status = self::static_status_for_courses();

        if ($request['name'] == "") {
          if(\Auth::user()->role_id == 1)
          {
            $cursos = DB::table("cursos")->where([
              ['creado_por','=', \Auth::user()->id]
            ])->get();
          }
          elseif(\Auth::user()->role_id == 4)
          {
            $instituto = \DB::table("institutos")->where(DB::raw("id_user"),\Auth::user()->id)->first();
            if(!is_null($instituto))
            {
              $cursos = DB::table("cursos")->where('creado_por','=', \Auth::user()->id)->orWhere('solicitado_por','=', $instituto->id_institutos)->get();
            }
          }
          elseif(\Auth::user()->role_id == 2)
          {
            $profesor = \DB::table("profesores")->where(DB::raw("id_user"),\Auth::user()->id)->first();
            if(!is_null($profesor))
            {
              $cursos = DB::table("cursos")->where('profesores_id_profesores','=', $profesor->id_profesores)->get();
            }
          }

        }
        else {
            $result = CourseBL::searchCourses_index($request->all());
            $cursos = $result->get();

            if($cursos->items() == null){
                return redirect()->route('my_courses')->with('error', 'El nombre indicado no existe');
            }

            else{
                $cursos->appends([
                    'nombre_cursos' => ($request->name == null?'':$request->name)
                    ]);
            }
            $request->flash();
        }
        $profesores = \DB::table('profesores')->get();

        return view('course.mis_cursos.index', [
            "cursos" => $cursos,
            "profesores" => $profesores,
            "schedule" => $schedule,
            'status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     /*funcionando*/
    public function create()
    {
        $sedes=Sede::all();
        $cursos=Course::all();
        $status = self::static_status_for_courses();
        $profesores =  \DB::table("profesores")->get();
        $generos = \DB::table("genders")->get();
        $institutos = \DB::table("institutos")->get();
        $status2 = self::static_status_for_institute_students();
        $currenteCourse = null;
        $schedules = null;

    return view('course.todos.create', [
            'sedes' => $sedes,
            'cursos' => $cursos,
            'status' => $status,
            'profesores' => $profesores,
            'generos' => $generos,
            'institutos' => $institutos,
            'status2' => $status2,
            'currenteCourse' => $currenteCourse,
            'schedules' => $schedules
          ]);
    }
    /*funcionando*/
    public function createLooping($id, $link)
    {
      $currenteCourse=\DB::table("cursos")->where('id_cursos',$id)->first();
      $sedes=Sede::all();
      $cursos=Course::all();
      $status = self::static_status_for_courses();
      $temas = \DB::table("temas_cursos")->get();
      $profesores =  \DB::table("profesores")->get();
      $generos = \DB::table("genders")->get();
      $institutos = \DB::table("institutos")->get();
      $status2 = self::static_status_for_institute_students();
      $estudiantes = DB::table("estudiante_institutos")->where('id_cursos', '=', $id)->get();
      $schedules = DB::table("schedule")->where('cursos_id_cursos', '=', $id)->get();
      return view('course.todos.create', compact('sedes','cursos','status','profesores','generos','institutos','status2','currenteCourse','temas','estudiantes','schedules', 'link'));
    }
    /*funcionando*/
    public function createCourse(CreateCourseRequest $request)
    {

        $data = $request->all();
        $idCourse=$request['id'];
        $course = \DB::table("cursos")->where([
            ['codigo_cursos', '=' ,$request['courseCode']]
        ])->first();



        if (is_null($course)) {
            if (CourseBL::storeCourse($request->all())) {
              $course = \DB::table("cursos")->where([['codigo_cursos', '=' ,$request['courseCode']]])->first();
              \Session::flash('sucess', 'Se ha creado el curso correctamente.');
                return self::createLooping($course->id_cursos, "toSchedule");
            }
            else {

              \Session::flash('error', 'No se ha creado el curso correctamente.');
                return self::createLooping(-1,"");
            }
        }
        if(!isset($request['id']))
        {
          \Session::flash('error', 'Hay un curso que existe con esas caracteristicas.');
          return self::createLooping(-1,"");
        }
        else
        {
            if (CourseBL::editCourse($request->all(),$data))
            {
              \Session::flash('sucess', 'Se ha modificado el curso correctamente.');
                return self::createLooping($course->id_cursos, "toSchedule");
            }else{
              \Session::flash('error', 'El curso no se pudo modificar.');
                return self::createLooping($course->id_cursos,"");
            }
        }


    }

    public function updateCourse(CreateCourseRequest $request)
    {
      $data = $request->all();
      if (CourseBL::editCourse($request->all(), $data))
      {
        \Session::flash('sucess', 'Se ha modificado el curso correctamente.');
          return self::course2($request['id'],"toSchedule");
      }else{
        \Session::flash('error', 'El curso no se pudo modificar.');
          return self::course2($request['id'],"");
      }
    }


    public function createSchedule(CreateCourseSchedule $request)
    {
        if (CourseBL::storeSchedule($request->all())) {
          \Session::flash('sucess' , 'El horario se ha creado correctamente.');
          return self::createLooping($request['courses1'],"toTheme");
        } else {
          \Session::flash('error' , 'Tema no se ha creado correctamente.');
          return self::createLooping($request['courses1'],"toSchedule");
        }
    }

    public function updateSchedule(CreateCourseSchedule $request)
    {
      if (CourseBL::storeSchedule($request->all())) {
         \Session::flash('sucess' , 'Horario se ha actualizado correctamente.');
          return self::course2($request['courses1'],"toTheme");
      } else {
         \Session::flash('error' , 'El horario no se pudo actualizar.');
          return self::course2($request['courses1'],"toSchedule");
      }
    }
    /*funcionando*/
    public function createTheme(CreateCourseTheme $request)
    {
      $tema = \DB::table("temas_cursos")->where(DB::raw("cursos_id_cursos"),$request['courses2'])->first();
      if(is_null($tema))
      {
          if (CourseBL::storeTheme($request->all())) {
              \Session::flash('sucess' , 'Tema se ha creado correctamente.');
              return self::createLooping($request['courses2'],"toStudent_institute");
          }
          else
          {
              \Session::flash('error' , 'El tema no se pudo crear.');
              return self::createLooping($request['courses2'],"toTheme");
          }
      }
      else
      {
        if (CourseBL::updateTheme($request->all())) {
            \Session::flash('sucess' , 'Tema se ha guardado correctamente.');
            return self::createLooping($request['courses2'], "toStudent_institute");
        }
        else
        {
            \Session::flash('error' , 'El tema no se ha guardado correctamente.');
            return self::createLooping($request['courses2'], "toTheme");
        }
      }
    }

    /*funcionando*/
    public function createThemeEdit(CreateCourseTheme $request)
    {
      $tema = \DB::table("temas_cursos")->where(DB::raw("cursos_id_cursos"),$request['courses2'])->first();
      if(is_null($tema))
      {
          if (CourseBL::storeTheme($request->all())) {
              \Session::flash('sucess' , 'Tema se ha creado correctamente.');
              return self::course2($request['courses2'],"toStudent_institute");
          }
          else
          {
              \Session::flash('error' , 'El tema no se pudo crear.');
              return self::course2($request['courses2'],"toTheme");
          }
      }
      else
      {
        if (CourseBL::updateTheme($request->all())) {
            \Session::flash('sucess' , 'Tema se ha guardado correctamente.');
            return self::course2($request['courses2'],"toStudent_institute");
        }
        else
        {
            \Session::flash('error' , 'El tema no se ha guardado correctamente.');
            return self::course2($request['courses2'],"toTheme");
        }
      }
    }


    public function createInstituteStudentTable(CreateCourseInsTable $request)
    {
        if (CourseBL::storeInstituteStudentTable($request->all())) {
          \Session::flash('sucess' , 'Los estudiantes se han guardado correctamente.');
          return self::createLooping($request['courses3'],"toComments");
        } else {
          \Session::flash('error' , 'Los estudiantes no se han guardado correctamente.');
          return self::createLooping($request['courses3'],"toStudent_institute");
        }
    }

    public function updateInstituteStudentTable(CreateCourseInsTable $request)
    {
        if (CourseBL::storeInstituteStudentTable($request->all())) {
          \Session::flash('sucess' , 'Los estudiantes se han guardado correctamente.');
          return self::course2($request['courses3'],"toComments");
        } else {
          \Session::flash('error' , 'Los estudiantes no se han guardado correctamente.');
          return self::course2($request['courses3'],"toStudent_institute");
        }
    }


    public function createInstituteStudentTable_for_details(CreateCourseInsTable $request)
    {
        if (CourseBL::storeInstituteStudentTable($request->all())) {
          \Session::flash('sucess' , 'Los estudiantes se han guardado correctamente.');
          return self::my_course2($request['courses3'], "toComments");
        } else {
          \Session::flash('error' , 'Los estudiantes no se han guardado correctamente.');
          return self::my_course2($request['courses3'], "toStudent_institute");
        }
    }


    public function edit(Request $request, $id )
    {
        if (CourseBL::editCourse($request->all(),$id)) {
            return redirect('courses/course/todos/{$id}')->with('sucess', 'Datos guardados correctamente.');
        }
        return redirect('courses/course/todos/{$id}')->with('error', 'Los datos no pudieron ser guardados.');
    }

    public function course($id)
    {
        $courses=DB::table("cursos")->where('id_cursos',$id)->first();
        $sedes=Sede::all();
        $cursos = DB::table("cursos")->get();
        $estados = self::static_status_for_courses();
        $temas = DB::table("temas_cursos")->get();
        $specificTheme = DB::table("temas_cursos")->where('cursos_id_cursos',$id)->get();
        $profesores =  DB::table("profesores")->get();
        $institutos = DB::table("institutos")->get();
        $generos = \DB::table("genders")->get();
        $estudiantes = DB::table("estudiante_institutos")->where('id_cursos', '=', $id)->get();
        $schedules = DB::table("schedule")->where('cursos_id_cursos', '=', $id)->get();
        $status2 = self::static_status_for_institute_students();
        $countSize=count($schedules);


        return view('course.todos.edit', compact('courses', 'sedes','cursos','estados','countSize','schedules','temas','specificTheme','profesores','institutos','generos','status2','estudiantes'));
    }
    public function course2($id, $link)
    {
        $courses=DB::table("cursos")->where('id_cursos',$id)->first();
        $sedes=Sede::all();
        $cursos = DB::table("cursos")->get();
        $estados = self::static_status_for_courses();
        $temas = DB::table("temas_cursos")->get();
        $specificTheme = DB::table("temas_cursos")->where('cursos_id_cursos',$id)->get();
        $profesores =  DB::table("profesores")->get();
        $institutos = DB::table("institutos")->get();
        $generos = \DB::table("genders")->get();
        $estudiantes = DB::table("estudiante_institutos")->where('id_cursos', '=', $id)->get();
        $schedules = DB::table("schedule")->where('cursos_id_cursos', '=', $id)->get();
        $status2 = self::static_status_for_institute_students();
        $countSize=count($schedules);


        return view('course.todos.edit', compact('courses', 'sedes','cursos','estados','countSize','schedules','temas','specificTheme','profesores','institutos','generos','status2','estudiantes', 'link'));
    }
    public function my_course($id)
    {
      $currenteCourse=\DB::table("cursos")->where('id_cursos',$id)->first();
      $sedes=Sede::all();
      $cursos=Course::all();
      $status = self::static_status_for_courses();
      $temas = \DB::table("temas_cursos")->get();
      $profesores =  \DB::table("profesores")->get();
      $generos = \DB::table("genders")->get();
      $institutos = \DB::table("institutos")->get();
      $status2 = self::static_status_for_institute_students();
      $estudiantes = DB::table("estudiante_institutos")->where('id_cursos', '=', $id)->get();
      $schedules = DB::table("schedule")->where('cursos_id_cursos', '=', $id)->get();
      return view('course.mis_cursos.detalle', compact('sedes','cursos','status','profesores','generos','institutos','status2','currenteCourse','temas','estudiantes','schedules'));
    }

    public function my_course2($id, $link)
    {
      $currenteCourse=\DB::table("cursos")->where('id_cursos',$id)->first();
      $sedes=Sede::all();
      $cursos=Course::all();
      $status = self::static_status_for_courses();
      $temas = \DB::table("temas_cursos")->get();
      $profesores =  \DB::table("profesores")->get();
      $generos = \DB::table("genders")->get();
      $institutos = \DB::table("institutos")->get();
      $status2 = self::static_status_for_institute_students();
      $estudiantes = DB::table("estudiante_institutos")->where('id_cursos', '=', $id)->get();
      $schedules = DB::table("schedule")->where('cursos_id_cursos', '=', $id)->get();
      return view('course.mis_cursos.detalle', compact('sedes','cursos','status','profesores','generos','institutos','status2','currenteCourse','temas','estudiantes','schedules', 'link'));
    }

    public function theme($id)
    {
        $courses=DB::table("cursos")->where('id_cursos',$id)->first();
        $sedes=Sede::all();
        $cursos = DB::table("cursos")->get();
        $estados = self::static_status_for_courses();
        $temas = DB::table("temas_cursos")->get();
        $idCourse = $id;


        $schedules = DB::table("schedule")->where('cursos_id_cursos', '=', $id)->get();
        $countSize=count($schedules);

        $temas = DB::table("temas_cursos")->get();
        $specificTheme = DB::table("temas_cursos")->where('cursos_id_cursos',$id)->get();

        return view('course.todos.editTheme', compact('courses', 'sedes','cursos','estados','countSize','schedules','specificTheme','temas','idCourse'));
    }


    public function deleteSchedule(Request $request)
    {

        if (CourseBL::detroySchedule($request->all())) {
            return redirect('courses/todos/create')->with('sucess', 'Horario se ha eliminado correctamente.');
        } else {
            return redirect()->route('createCourses')->with('error', 'El horario no se pudo eliminar.');
        }
    }

    public function destroyCourse(Request $request)
    {
        $data = $request->all();
        $idCourse=$request['id'];

        if (CourseBL::detroyCourse($request->all(),$idCourse)) {
            return redirect('courses/todos/index')->with('sucess', 'Curso se ha elimanado correctamente.');
        } else {
            return redirect()->route('courses/index')->with('error', 'El curso no se pudo eliminar.');
        }
    }

    public function destroyCourseTheme(Request $request)
    {


        if (CourseBL::destroyCourseTheme($request->all())) {
            return redirect('courses/todos/index')->with('sucess', 'Tema se ha elimanado correctamente.');
        } else {
            return redirect()->route('courses/index')->with('error', 'El Tema no se pudo eliminar.');
        }
    }
    /*funcionando*/
    public function comments(Request $request)
    {
        if (CourseBL::storeComments($request->all())) {
            \Session::flash('sucess' , 'Los comentarios se ha guardado correctamente');
            return redirect('courses/todos/index');
        } else {
            \Session::flash('error' , 'Los comentarios no se han guardado correctamente.');
            return self::createLooping($request['courses4'],"toComments");
        }
    }
    /*funcionando*/
    public function updateComments(Request $request)
    {

        if (CourseBL::storeComments($request->all())) {
            \Session::flash('sucess' , 'Los comentarios se ha guardado correctamente');
            return redirect('courses/todos/index');
        } else {
            \Session::flash('error' , 'Los comentarios no se han guardado correctamente.');
            return self::course2($request['courses4'],"");
        }

    }
    /*funcionando*/
    public function comments_for_details(Request $request)
    {

        if (CourseBL::storeComments($request->all())) {
            \Session::flash('sucess' , 'Los comentarios se ha guardado correctamente');
            return self::index_mis_cursos_redirection();
        } else {
            \Session::flash('error' , 'Los comentarios no se han guardado correctamente.');
            return self::my_course2($request['courses4'], "toComments");
        }
    }

    public function inscripcion($id_curso)
    {
      if (CourseBL::course_inscription($id_curso)) {
          \Session::flash('sucess' , 'Inscripción realizada.');
          return self::index_mis_cursos_redirection();
      } else {
          \Session::flash('error' , 'La inscripción no se realizo correctamente.');
          return self::index_mis_cursos_redirection();
      }
    }

    public function eliminar_inscripcion($id_curso)
    {
      if (CourseBL::remove_course_inscription($id_curso)) {
          \Session::flash('sucess' , 'Inscripción eliminada.');
          return self::index_mis_cursos_redirection();
      } else {
          \Session::flash('error' , 'La inscripción no se elimino correctamente.');
          return self::index_mis_cursos_redirection();
      }
    }

    public function solicitar_curso($id_curso)
    {

      if (CourseBL::request_course($id_curso)) {
          \Session::flash('sucess' , 'Solicitud realizada.');
          return self::index_mis_cursos_redirection();
      } else {
          \Session::flash('error' , 'La solicitud no se realizo correctamente.');
          return self::index_mis_cursos_redirection();
      }
    }

    public function eliminar_solicitud_curso($id_curso)
    {
      if (CourseBL::remove_request_course($id_curso)) {
          \Session::flash('sucess' , 'Solicitud eliminada.');
          return self::index_mis_cursos_redirection();
      } else {
          \Session::flash('error' , 'La solicitud no se elimino correctamente.');
          return self::index_mis_cursos_redirection();
      }

    }

    public function index_mis_cursos_redirection()
    {
      return redirect()->route('my_courses');
    }

    public function proceso_curso_estudiante_universidad(Request $request)
    {
      $cursos = CourseBL::proceso_curso_estudiante();
      $horas = CourseBL::proceso_curso_estudiante_horas();
      $status = self::static_status_for_courses();
      $profesores = \DB::table('profesores')->get();
      return view("course.proceso.index", compact('cursos', 'status','horas','profesores'));
    }

    public function showPolicy($id)
    {

      $msg = CourseBL::showPolicy($id);
      if(!is_null($msg))
      {
        header('Content-Type:pdf');
        echo $msg;
      }
    }

    public function showAuthorizationLetter($id)
    {
      $msg = CourseBL::showAuthorizationLetter($id);
      if(!is_null($msg))
      {
        header('Content-Type:pdf');
        echo $msg;
      }
    }

    public function static_status_for_courses()
    {
              //Estos son estados ya creados en la base de datos, pero por motivo a que hay demasiados se filtraran
      return (object) [
        (object)[
          'id' => '1',
          'name' => 'Nuevo'
        ],
        (object)[
          'id' => '9',
          'name' => 'Pendiente'
        ],
        (object)[
          'id' => '2',
          'name' => 'Aprobado'
        ],
        (object)[
          'id' => '13',
          'name' => 'Activo'
        ],
        (object)[
          'id' => '11',
          'name' => 'Asignado'
        ],
        (object)[
          'id' => '16',
          'name' => 'En Proceso'
        ],
        (object)[
          'id' => '12',
          'name' => 'Finalizado'
        ],
        (object)[
          'id' => '3',
          'name' => 'Rechazado'
        ]
      ];

    }

    public function static_status_for_institute_students()
    {
      return (object) [
        (object)[
          'id' => '1',
          'name' => 'Nuevo'
        ],
        (object)[
          'id' => '9',
          'name' => 'Pendiente'
        ],
        (object)[
          'id' => '2',
          'name' => 'Aprobado'
        ],
        (object)[
          'id' => '3',
          'name' => 'Rechazado'
        ]
      ];
    }


}
