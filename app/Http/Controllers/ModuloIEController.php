<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Investigacion;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ModuloIEFormRequest;
use DB;

class ModuloIEController extends Controller
{


    public function __construct()
    {
$this->middleware('auth');
    }

public function redirect(Request $request){

  return view('ModuloInvestigacionExtension/ModuloIE/Proyecto/redirectUser/');

}

public function index(Request $request){

  //return view('Ciad.Modulo_IE.index');

if ($request){

	//$query = trim($request->get('searchText'));

//if (empty($query)){

$strM = intval($request->userId);

  $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('tipo_proyecto', 'proyecto_investigacion.tipo_proyecto_id', '=', 'tipo_proyecto.tipo_proyecto_id')

   ->join('condicion_proyecto', 'proyecto_investigacion.condicion_proyecto_id', '=', 'condicion_proyecto.condicion_proyecto_id')

   ->join('estado_proyecto', 'proyecto_investigacion.estado_proyecto_id', '=', 'estado_proyecto.estado_proyecto_id')

   ->join('ulatina_carreras', 'proyecto_investigacion.id_carreras_ulatina', '=', 'ulatina_carreras.id_carreras_ulatina')

   ->select('proyecto_investigacion.*', 'tipo_proyecto.*', 'condicion_proyecto.*',

            'estado_proyecto.*', 'ulatina_carreras.*')
  ->get();

  $usuarios_proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('person_profiles As users', 'usuario_proyecto.users_id', '=', 'users.id')

   ->select('proyecto_investigacion.proyecto_investigacion_id', 'usuario_proyecto.usuario_proyecto_id', 'usuario_proyecto.tipo_usuario_proyecto_id',

            'users.id', 'users.first_name AS name')

  ->get();


  $profesores = DB::CONNECTION('mysql')->table('person_profiles As users')
  ->get();


    $currentUser = DB::CONNECTION('mysql')->table('users')
                ->where('id','=',$strM)
                ->get();


  $proyectoArray = array();







        if(auth()->user()->role_id==1){

          foreach ($proyecto as $info) {

                  foreach ($usuarios_proyecto as $usuario) {

                      if($usuario->proyecto_investigacion_id==$info->proyecto_investigacion_id && $usuario->id==auth()->user()->id){
                             array_push($proyectoArray, $info->proyecto_investigacion_id);
                      }else{
                              array_push($proyectoArray, $info->proyecto_investigacion_id);
                      }

                  }

            }

        }else{

            foreach ($proyecto as $info) {

                  foreach ($usuarios_proyecto as $usuario) {

                      if($usuario->proyecto_investigacion_id==$info->proyecto_investigacion_id && $usuario->id==auth()->user()->id){
                             array_push($proyectoArray, $info->proyecto_investigacion_id);
                      }else if($info->condicion_proyecto_id==2&&$info->estado_proyecto_id==3){
                              array_push($proyectoArray, $info->proyecto_investigacion_id);
                      }

                  }

            }

      }






  $resultado = array_unique($proyectoArray);


	//$proyecto = DB::table('proyecto_investigacion')->paginate(10);
	return view('ModuloIE.Proyecto.index',['proyecto'=>$proyecto, 'usuarios_proyecto'=>$usuarios_proyecto, 'proyectoArray'=>$resultado]);

//}

// else{



// $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

//    ->join('tipo_proyecto', 'proyecto_investigacion.tipo_proyecto_id', '=', 'tipo_proyecto.tipo_proyecto_id')

//    ->join('condicion_proyecto', 'proyecto_investigacion.condicion_proyecto_id', '=', 'condicion_proyecto.condicion_proyecto_id')

//    ->join('estado_proyecto', 'proyecto_investigacion.estado_proyecto_id', '=', 'estado_proyecto.estado_proyecto_id')

//    ->join('ulatina_carreras', 'proyecto_investigacion.id_carreras_ulatina', '=', 'ulatina_carreras.id_carreras_ulatina')

//    ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

//    ->join('person_profiles As users', 'usuario_proyecto.users_id', '=', 'users.id')

//    ->where('users.name','LIKE','%'.$query.'%')

//    ->where('usuario_proyecto.tipo_usuario_proyecto_id','!=','2')

//    ->select('proyecto_investigacion.*', 'tipo_proyecto.*', 'condicion_proyecto.*',

//             'estado_proyecto.*', 'ulatina_carreras.*')
//   ->get();

//   //print_r($proyecto);

//   $usuarios_proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

//    ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

//    ->join('person_profiles As users', 'usuario_proyecto.users_id', '=', 'users.id')

//    ->select('proyecto_investigacion.proyecto_investigacion_id', 'usuario_proyecto.usuario_proyecto_id', 'usuario_proyecto.tipo_usuario_proyecto_id',

//             'users.name')

//   ->get();

//   //$proyecto = DB::table('proyecto_investigacion')->paginate(10);
//   return view('ModuloIE.Proyecto.index',['proyecto'=>$proyecto, 'usuarios_proyecto'=>$usuarios_proyecto, 'searchText'=>$query]);



// }

	 //return view("Ciad.Facultad.index");

}


}



public function redirectUserP()
{
  return Redirect::to('/ModuloIE/Proyecto/');
}




public function createPlanTrabajo($proyecto_investigacion_id)
{

    $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

   ->where('usuario_proyecto.tipo_usuario_proyecto_id','=',2)

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


     $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

   ->where('usuario_proyecto.tipo_usuario_proyecto_id','=',2)

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $profesores = $a->merge($b);


   $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)

  ->select('proyecto_investigacion.*')

  ->first();


    return view('ModuloIE.PlanDeTrabajo.create',['profesores'=>$profesores, 'proyecto'=>$proyecto]);

}


public function guardarPlanTrabajo(Request $request)
{

      $tabla = 'plan_proyecto';

if($request->ajax()){

            $plan_proyecto_nombre = strval($request->plan_proyecto_nombre);
            $periodo = strval($request->periodo);
            $responsable = intval($request->responsable);
            $cantidad_encargados = intval($request->cantidad_encargados);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);

  DB::CONNECTION('mysql')->table('plan_proyecto')->insert([
    ['plan_proyecto_nombre' => $plan_proyecto_nombre,
    'periodo' => $periodo,
    'responsable' => $responsable,
    'cantidad_encargados' => $cantidad_encargados,
    'proyecto_investigacion_id' => $proyecto_investigacion_id]
]);



  return response()->json();

}




}


public function editPlanTrabajo($proyecto_investigacion_id, $plan_proyecto_id)
{


    $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

   ->where('usuario_proyecto.tipo_usuario_proyecto_id','=',2)

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


     $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

   ->where('usuario_proyecto.tipo_usuario_proyecto_id','=',2)

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $profesores = $a->merge($b);


   $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)

  ->select('proyecto_investigacion.*')

  ->first();


   $planTrabajoArray = DB::CONNECTION('mysql')->table('plan_proyecto')

  ->where('plan_proyecto_id', '=', $plan_proyecto_id)

  ->select('plan_proyecto.*')

  ->first();

   $planTrabajoArray2 = DB::CONNECTION('mysql')->table('plan_proyecto')

  ->where('plan_proyecto_id', '=', $plan_proyecto_id)

  ->get();


  //    $planTrabajoArray = DB::CONNECTION('mysql')->table('plan_proyecto')

  // ->where('plan_proyecto_id', '=', $plan_proyecto_id)

  // ->select('plan_proyecto.*')

  // ->first();


      $d = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

    ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

   ->join('admins', 'encargado_plan_proyecto.user_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

    ->where('plan_proyecto.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

    ->where('encargado_plan_proyecto.activo', '=', 1)

    ->where('plan_proyecto.periodo', '=', $planTrabajoArray2[0]->periodo)

   ->select('plan_proyecto.plan_proyecto_id', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


    $c = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

    ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

    ->join('students', 'encargado_plan_proyecto.user_id', '=', 'students.user_id')

    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

    ->where('plan_proyecto.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

    ->where('encargado_plan_proyecto.activo', '=', 1)

    ->where('plan_proyecto.periodo', '=', $planTrabajoArray2[0]->periodo)

    ->select('plan_proyecto.plan_proyecto_id', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

    ->get();

  $encargadosObj2 = $c->merge($d);

    $encargadosObj3 = [];

    foreach ($encargadosObj2 as $proyectoP) {

      if($proyectoP->plan_proyecto_id==$plan_proyecto_id){

        array_push($encargadosObj3, $proyectoP->id);

      }



    }


    $encargadosObj = array_unique($encargadosObj3);


    return view('ModuloIE.PlanDeTrabajo.edit',['profesores'=>$profesores, 'proyecto'=>$proyecto, 'planTrabajoArray'=>$planTrabajoArray, 'encargadosObj'=>$encargadosObj, 'encargadosObj2'=>$encargadosObj2]);

}


public function verPlanTrabajo($proyecto_investigacion_id, $plan_proyecto_id)
{

       $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

   ->where('usuario_proyecto.tipo_usuario_proyecto_id','=',2)

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


     $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

   ->where('usuario_proyecto.tipo_usuario_proyecto_id','=',2)

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $profesores = $a->merge($b);


   $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)

  ->select('proyecto_investigacion.*')

  ->first();


   $planTrabajoArray = DB::CONNECTION('mysql')->table('plan_proyecto')

  ->where('plan_proyecto_id', '=', $plan_proyecto_id)

  ->select('plan_proyecto.*')

  ->first();


    return view('ModuloIE.PlanDeTrabajo.ver',['profesores'=>$profesores, 'proyecto'=>$proyecto, 'planTrabajoArray'=>$planTrabajoArray]);

}


public function modificarPlanTrabajo(Request $request)
{

      $tabla = 'plan_proyecto';

if($request->ajax()){

            $plan_proyecto_id = intval($request->plan_proyecto_id);
            $plan_proyecto_nombre = strval($request->plan_proyecto_nombre);
            $periodo = strval($request->periodo);
            $responsable = intval($request->responsable);
            $cantidad_encargados = intval($request->cantidad_encargados);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);

  DB::CONNECTION('mysql')->table('plan_proyecto')
  ->where('plan_proyecto_id', '=', $plan_proyecto_id)
  ->update(
    ['plan_proyecto_nombre' => $plan_proyecto_nombre,
    'periodo' => $periodo,
    'responsable' => $responsable,
    'cantidad_encargados' => $cantidad_encargados,
    'proyecto_investigacion_id' => $proyecto_investigacion_id]
);



  return response()->json();

}




}



    public function cargarPlanTrabajo(Request $request)
    {

              if($request->ajax()){

              $strM = intval($request->proyecto_investigacion_id);


                  $b = DB::CONNECTION('mysql')->table('plan_proyecto')

                 ->join('admins', 'plan_proyecto.responsable', '=', 'admins.user_id')

                 ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

                 ->where('plan_proyecto.proyecto_investigacion_id', '=', $strM)

                 ->select('plan_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

                 ->get();


                 $a = DB::CONNECTION('mysql')->table('plan_proyecto')

                 ->join('students', 'plan_proyecto.responsable', '=', 'students.user_id')

                 ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

                 ->where('plan_proyecto.proyecto_investigacion_id', '=', $strM)

                 ->select('plan_proyecto.*', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

                 ->get();



                $planes = $a->merge($b);




                return response()->json(
                 ['data' => $planes]
              );

              }



    }


        public function cargarObjetivosPlan(Request $request)
    {

              if($request->ajax()){

              $strM = intval($request->plan_proyecto_id);


                $planes = DB::CONNECTION('mysql')->table('plan_proyecto')

                ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

                ->join('objetivo_proyecto', 'objetivo_plan_proyecto.objetivo_proyecto_id', '=', 'objetivo_proyecto.objetivo_proyecto_id')

                ->where('plan_proyecto.plan_proyecto_id', '=', $strM)

                ->select('plan_proyecto.*', 'objetivo_plan_proyecto.*', 'objetivo_proyecto.*')

                ->get();



                 $d = DB::CONNECTION('mysql')->table('plan_proyecto')

                ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

                ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

                ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

                ->join('admins', 'encargado_plan_proyecto.user_id', '=', 'admins.user_id')

                ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

                ->where('plan_proyecto.plan_proyecto_id', '=', $strM)

                ->select('plan_proyecto.*', 'objetivo_plan_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

                ->get();


                $c = DB::CONNECTION('mysql')->table('plan_proyecto')

                ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

                ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

                ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

                ->join('students', 'encargado_plan_proyecto.user_id', '=', 'students.user_id')

                ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

                ->where('plan_proyecto.plan_proyecto_id', '=', $strM)

                ->select('plan_proyecto.*', 'objetivo_plan_proyecto.*', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

                ->get();

              $encargadosObj = $c->merge($d);




                return response()->json(
                 ['data' => $planes, 'data2' => $encargadosObj]
              );

              }



    }


public function createObjetivoPlanTrabajo($proyecto_investigacion_id, $plan_proyecto_id)
{



      $planPT = DB::CONNECTION('mysql')->table('plan_proyecto')

         ->where('plan_proyecto_id','=',$plan_proyecto_id)

         ->get();

         print_r($planPT[0]->periodo);


         $f_Inicio = "";
         $f_Final = "";
         $vrSplit = preg_split('/-/', $planPT[0]->periodo, -1, PREG_SPLIT_OFFSET_CAPTURE);
         $period = $vrSplit[1][0];
         $year = $vrSplit[0][0];


         if ($period==1){

             $f_Inicio = (intval($year)-1)."/11/01";
             $f_Final = $year."/02/01";

         }else if ($period==2){

             $f_Inicio = $year."/03/01";
             $f_Final  = $year."/06/01";

         }else if ($period==3){

             $f_Inicio = $year."/07/01";
             $f_Final = $year."/10/01";

         }


      $b = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

   ->join('admins', 'encargado_plan_proyecto.user_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('encargado_plan_proyecto.proyecto_invetigacion_id','=',$proyecto_investigacion_id)

   ->where('encargado_plan_proyecto.activo','=',1)

   ->whereBetween('encargado_plan_proyecto.fecha_registro', [$f_Inicio, $f_Final])

   ->select('encargado_plan_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


    $a = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

   ->join('students', 'encargado_plan_proyecto.user_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('encargado_plan_proyecto.proyecto_invetigacion_id','=',$proyecto_investigacion_id)

   ->where('encargado_plan_proyecto.activo','=',1)

   ->whereBetween('encargado_plan_proyecto.fecha_registro', [$f_Inicio, $f_Final])

   ->select('encargado_plan_proyecto.*', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


  $profesores = $a->merge($b);




  $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  ->join('plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'plan_proyecto.proyecto_investigacion_id')

  ->where('proyecto_investigacion.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

  ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

  ->select('proyecto_investigacion.*', 'plan_proyecto.*')

  ->first();


  $objetivosP = DB::CONNECTION('mysql')->table('objetivo_proyecto')

  ->where('proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

  ->get();


  $estado = DB::CONNECTION('mysql')->table('estado_objetivo')->get();


   $planes = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_proyecto', 'objetivo_plan_proyecto.objetivo_proyecto_id', '=', 'objetivo_proyecto.objetivo_proyecto_id')

    ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

    ->select('plan_proyecto.*', 'objetivo_plan_proyecto.*', 'objetivo_proyecto.*')

    ->get();



    $d = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

    ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

   ->join('admins', 'encargado_plan_proyecto.user_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

    ->where('plan_proyecto.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

    ->where('encargado_plan_proyecto.activo', '=', 1)

    ->where('plan_proyecto.periodo', '=', $planPT[0]->periodo)

   ->select('plan_proyecto.*', 'encargado_plan_proyecto.*', 'objetivo_plan_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


    $c = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

    ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

    ->join('students', 'encargado_plan_proyecto.user_id', '=', 'students.user_id')

    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

    ->where('plan_proyecto.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

    ->where('encargado_plan_proyecto.activo', '=', 1)

    ->where('plan_proyecto.periodo', '=', $planPT[0]->periodo)

    ->select('plan_proyecto.*', 'encargado_plan_proyecto.*', 'objetivo_plan_proyecto.*', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

    ->get();

    $encargadosObj = $c->merge($d);

       $encargadosObj3 = [];

       foreach ($encargadosObj as $proyectoP) {

         if($proyectoP->plan_proyecto_id==$plan_proyecto_id){

           array_push($encargadosObj3, $proyectoP->id);

         }



       }

       $encargadosObj2 = array_unique($encargadosObj3);


  return view('ModuloIE.ObjetivoPlan.create',['profesores'=>$profesores, 'proyecto'=>$proyecto, 'objetivosP'=>$objetivosP, 'estado'=>$estado, 'planes' => $planes, 'encargadosObj' => $encargadosObj, 'encargadosObj2' => $encargadosObj2]);


  //return view('ModuloIE.ObjetivoPlan.create');

}


public function editObjetivoPlanTrabajo($proyecto_investigacion_id, $plan_proyecto_id, $objetivo_plan_proyecto_id)
{

       $planPT = DB::CONNECTION('mysql')->table('plan_proyecto')

         ->where('plan_proyecto_id','=',$plan_proyecto_id)

         ->get();

         print_r($planPT[0]->periodo);


         $f_Inicio = "";
         $f_Final = "";
         $vrSplit = preg_split('/-/', $planPT[0]->periodo, -1, PREG_SPLIT_OFFSET_CAPTURE);
         $period = $vrSplit[1][0];
         $year = $vrSplit[0][0];


         if ($period==1){

             $f_Inicio = (intval($year)-1)."/11/01";
             $f_Final = $year."/02/01";

         }else if ($period==2){

             $f_Inicio = $year."/03/01";
             $f_Final  = $year."/06/01";

         }else if ($period==3){

             $f_Inicio = $year."/07/01";
             $f_Final = $year."/10/01";

         }


      $b = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

   ->join('admins', 'encargado_plan_proyecto.user_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('encargado_plan_proyecto.proyecto_invetigacion_id','=',$proyecto_investigacion_id)

   ->where('encargado_plan_proyecto.activo','=',1)

   ->whereBetween('encargado_plan_proyecto.fecha_registro', [$f_Inicio, $f_Final])

   ->select('encargado_plan_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


    $a = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

   ->join('students', 'encargado_plan_proyecto.user_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('encargado_plan_proyecto.proyecto_invetigacion_id','=',$proyecto_investigacion_id)

   ->where('encargado_plan_proyecto.activo','=',1)

   ->whereBetween('encargado_plan_proyecto.fecha_registro', [$f_Inicio, $f_Final])

   ->select('encargado_plan_proyecto.*', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


  $profesores = $a->merge($b);


  $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  ->join('plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'plan_proyecto.proyecto_investigacion_id')

  ->where('proyecto_investigacion.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

  ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

  ->select('proyecto_investigacion.*', 'plan_proyecto.*')

  ->first();


  $objetivosP = DB::CONNECTION('mysql')->table('objetivo_proyecto')

  ->where('proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

  ->get();


  $estado = DB::CONNECTION('mysql')->table('estado_objetivo')->get();


   $planes = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_proyecto', 'objetivo_plan_proyecto.objetivo_proyecto_id', '=', 'objetivo_proyecto.objetivo_proyecto_id')

    ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

    ->select('plan_proyecto.*', 'objetivo_plan_proyecto.*', 'objetivo_proyecto.*')

    ->get();



    $planEdit = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_proyecto', 'objetivo_plan_proyecto.objetivo_proyecto_id', '=', 'objetivo_proyecto.objetivo_proyecto_id')

    ->where('objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', $objetivo_plan_proyecto_id)

    ->select('plan_proyecto.*', 'objetivo_plan_proyecto.*', 'objetivo_proyecto.objetivo_proyecto_id', 'objetivo_proyecto.objetivo_proyecto_descripcion')

    ->get();


    $observacionesPlan = DB::CONNECTION('mysql')->table('observacion_objetivo_plan')

   ->where('observacion_objetivo_plan.objetivo_plan_proyecto_id', '=', $objetivo_plan_proyecto_id)

   ->select('observacion_objetivo_plan.*')

   ->get();


   $d = DB::CONNECTION('mysql')->table('plan_proyecto')

   ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

   ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

   ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

  ->join('admins', 'encargado_plan_proyecto.user_id', '=', 'admins.user_id')

  ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('plan_proyecto.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

   ->where('encargado_plan_proyecto.activo', '=', 1)

   ->where('plan_proyecto.periodo', '=', $planPT[0]->periodo)

  ->select('plan_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


   $c = DB::CONNECTION('mysql')->table('plan_proyecto')

   ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

   ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

   ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

   ->join('students', 'encargado_plan_proyecto.user_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('plan_proyecto.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

   ->where('encargado_plan_proyecto.activo', '=', 1)

   ->where('plan_proyecto.periodo', '=', $planPT[0]->periodo)

   ->select('plan_proyecto.*', 'encargado_plan_proyecto.*', 'objetivo_plan_proyecto.*', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();

 $encargadosObj = $c->merge($d);

    $encargadosObj3 = [];

    foreach ($encargadosObj as $proyectoP) {

      if($proyectoP->plan_proyecto_id==$plan_proyecto_id){

        array_push($encargadosObj3, $proyectoP->id);

      }



    }

    $encargadosObj2 = array_unique($encargadosObj3);


  return view('ModuloIE.ObjetivoPlan.edit',['profesores'=>$profesores, 'proyecto'=>$proyecto, 'objetivosP'=>$objetivosP, 'estado'=>$estado, 'planes' => $planes, 'encargadosObj' => $encargadosObj, 'encargadosObj2' => $encargadosObj2, 'planEdit' => $planEdit, 'observacionesPlan' => $observacionesPlan]);


  //return view('ModuloIE.ObjetivoPlan.create');

}


public function verObjetivoPlanTrabajo($proyecto_investigacion_id, $plan_proyecto_id, $objetivo_plan_proyecto_id)
{

      $b = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

   ->join('admins', 'encargado_plan_proyecto.user_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('encargado_plan_proyecto.proyecto_invetigacion_id','=',$proyecto_investigacion_id)

   ->where('encargado_plan_proyecto.activo','=',1)

   ->select('encargado_plan_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


    $a = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

   ->join('students', 'encargado_plan_proyecto.user_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('encargado_plan_proyecto.proyecto_invetigacion_id','=',$proyecto_investigacion_id)

   ->where('encargado_plan_proyecto.activo','=',1)

   ->select('encargado_plan_proyecto.*', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


  $profesores = $a->merge($b);


  $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  ->join('plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'plan_proyecto.proyecto_investigacion_id')

  ->where('proyecto_investigacion.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

  ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

  ->select('proyecto_investigacion.*', 'plan_proyecto.*')

  ->first();


  $objetivosP = DB::CONNECTION('mysql')->table('objetivo_proyecto')

  ->where('proyecto_investigacion_id','=',''.$proyecto_investigacion_id.'')

  ->get();


  $estado = DB::CONNECTION('mysql')->table('estado_objetivo')->get();


   $planes = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_proyecto', 'objetivo_plan_proyecto.objetivo_proyecto_id', '=', 'objetivo_proyecto.objetivo_proyecto_id')

    ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

    ->select('plan_proyecto.*', 'objetivo_plan_proyecto.*', 'objetivo_proyecto.*')

    ->get();



    $planEdit = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_proyecto', 'objetivo_plan_proyecto.objetivo_proyecto_id', '=', 'objetivo_proyecto.objetivo_proyecto_id')

    ->where('objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', $objetivo_plan_proyecto_id)

    ->select('plan_proyecto.*', 'objetivo_plan_proyecto.*', 'objetivo_proyecto.objetivo_proyecto_id', 'objetivo_proyecto.objetivo_proyecto_descripcion')

    ->get();


    $observacionesPlan = DB::CONNECTION('mysql')->table('observacion_objetivo_plan')

   ->where('observacion_objetivo_plan.objetivo_plan_proyecto_id', '=', $objetivo_plan_proyecto_id)

   ->select('observacion_objetivo_plan.*')

   ->get();


    $d = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

    ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

   ->join('admins', 'encargado_plan_proyecto.user_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

    ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

   ->select('plan_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

   ->get();


    $c = DB::CONNECTION('mysql')->table('plan_proyecto')

    ->join('objetivo_plan_proyecto', 'plan_proyecto.plan_proyecto_id', '=', 'objetivo_plan_proyecto.plan_proyecto_id')

    ->join('objetivo_asignado', 'objetivo_plan_proyecto.objetivo_plan_proyecto_id', '=', 'objetivo_asignado.objetivo_plan_proyecto_id')

    ->join('encargado_plan_proyecto', 'objetivo_asignado.encargado_plan_proyecto_id', '=', 'encargado_plan_proyecto.encargado_plan_proyecto_id')

    ->join('students', 'encargado_plan_proyecto.user_id', '=', 'students.user_id')

    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

    ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

    ->select('plan_proyecto.*', 'encargado_plan_proyecto.*', 'objetivo_plan_proyecto.*', 'students.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

    ->get();

  $encargadosObj = $c->merge($d);


  return view('ModuloIE.ObjetivoPlan.ver',['profesores'=>$profesores, 'proyecto'=>$proyecto, 'objetivosP'=>$objetivosP, 'estado'=>$estado, 'planes' => $planes, 'encargadosObj' => $encargadosObj, 'planEdit' => $planEdit, 'observacionesPlan' => $observacionesPlan]);


  //return view('Ciad.ModuloIE.ObjetivoPlan.create');

}


public function guardarObjetivoPlan(Request $request)
{



if($request->ajax()){

            $objetivo_proyecto_id = intval($request->objetivo_proyecto_id);
            $fecha_inicio = strval($request->fecha_inicio);
            $fecha_final = strval($request->fecha_final);
            $indicadores = strval($request->indicadores);
            $resultado_esperado = strval($request->resultado_esperado);
            $recursos = strval($request->recursos);
            $estado_objetivo_id = intval($request->estado_objetivo_id);
            $plan_proyecto_id = intval($request->plan_proyecto_id);

  DB::CONNECTION('mysql')->table('objetivo_plan_proyecto')->insert([
    ['objetivo_proyecto_id' => $objetivo_proyecto_id,
    'fecha_inicio' => $fecha_inicio,
    'fecha_final' => $fecha_final,
    'indicadores' => $indicadores,
    'resultado_esperado' => $resultado_esperado,
    'recursos' => $recursos,
    'estado_objetivo_id' => $estado_objetivo_id,
    'plan_proyecto_id' => $plan_proyecto_id]
]);


  $objetivoInfo = DB::CONNECTION('mysql')->table('objetivo_plan_proyecto')
->where('plan_proyecto_id','=',$plan_proyecto_id)
->orderBy('objetivo_plan_proyecto_id', 'DESC')
->take(1)
->get();



  return response()->json(['objetivoInfo' => $objetivoInfo]);

}




}



public function modificarObjetivoPlan(Request $request)
{



if($request->ajax()){

            $objetivo_plan_proyecto_id = intval($request->objetivo_plan_proyecto_id);
            $objetivo_proyecto_id = intval($request->objetivo_proyecto_id);
            $fecha_inicio = strval($request->fecha_inicio);
            $fecha_final = strval($request->fecha_final);
            $indicadores = strval($request->indicadores);
            $resultado_esperado = strval($request->resultado_esperado);
            $recursos = strval($request->recursos);
            $estado_objetivo_id = intval($request->estado_objetivo_id);

  DB::CONNECTION('mysql')->table('objetivo_plan_proyecto')
  ->where('objetivo_plan_proyecto_id','=',$objetivo_plan_proyecto_id)
  ->update(
    ['objetivo_proyecto_id' => $objetivo_proyecto_id,
    'fecha_inicio' => $fecha_inicio,
    'fecha_final' => $fecha_final,
    'indicadores' => $indicadores,
    'resultado_esperado' => $resultado_esperado,
    'recursos' => $recursos,
    'estado_objetivo_id' => $estado_objetivo_id]
);




  return response()->json();

}




}



public function guardarEncargadoAsignado(Request $request)
{


if($request->ajax()){

            $encargado_plan_proyecto_id = intval($request->encargado_plan_proyecto_id);
            $objetivo_plan_proyecto_id = intval($request->objetivo_plan_proyecto_id);


  DB::CONNECTION('mysql')->table('objetivo_asignado')->insert(
    ['encargado_plan_proyecto_id' => $encargado_plan_proyecto_id,
    'objetivo_plan_proyecto_id' => $objetivo_plan_proyecto_id]
);



  return response()->json();

}


}


public function guardarObservacionesObjetivo(Request $request)
{



if($request->ajax()){

            $observacion_objetivo_plan_descripcion = strval($request->observacion_objetivo_plan_descripcion);
            $user_id = intval($request->user_id);
            $fecha = date("Y-m-d H:i:s");
            $objetivo_plan_proyecto_id = intval($request->objetivo_plan_proyecto_id);


  DB::CONNECTION('mysql')->table('observacion_objetivo_plan')->insert(
    ['observacion_objetivo_plan_descripcion' => $observacion_objetivo_plan_descripcion,
    'user_id' => $user_id,
    'fecha' => $fecha,
    'objetivo_plan_proyecto_id' => $objetivo_plan_proyecto_id]
);



  return response()->json();

}




}


public function eliminarObservacionObjetivo(Request $request)
{

    if($request->ajax()){

        $observacion_objetivo_plan_id = intval($request->observacion_objetivo_plan_id);

        DB::CONNECTION('mysql')->table('observacion_objetivo_plan')
        ->where('observacion_objetivo_plan_id', '=', $observacion_objetivo_plan_id)
        ->delete();


      return response()->json('Saved');
    }

}


    public function consultarUsuario(Request $request)
    {



      if($request->ajax()){

        $strM = intval($request->id);
if (auth()->user()->role_id==1){

    $usuario = DB::CONNECTION('mysql')->table('admins')

  ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

  ->where('admins.user_id', '=', auth()->user()->id)

  ->select('users.id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();

}else{

  $usuario = DB::CONNECTION('mysql')->table('students')

  ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

  ->where('students.user_id', '=', auth()->user()->id)

  ->select('users.id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();

}





  return response()->json(
   ['data' => $usuario]
);

}



    }





    public function buscarID(Request $request)
    {



      if($request->ajax()){

        $strM = intval($request->idCol);


  $usuario = DB::CONNECTION('mysql')->table('students')
    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')
    ->where('students.id_document', '=', $strM)
    ->orwhere('students.university_identification', '=', $strM)
    ->select('students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))
  ->get();




  return response()->json(
   ['data' => $usuario]
);

}



    }



    public function buscarEmail(Request $request)
    {



      if($request->ajax()){

        $strM = strval($request->emailCol);


    $usuario = DB::CONNECTION('mysql')->table('students')
    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')
    ->where(DB::raw('UPPER (university_email)'),'LIKE','%'.strtoupper($strM).'%')
    ->orwhere(DB::raw('UPPER (personal_email)'),'LIKE','%'.strtoupper($strM).'%')
    ->select('students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))
  ->get();




  return response()->json(
   ['data' => $usuario]
);

}



    }



        public function buscarName(Request $request)
    {



      if($request->ajax()){



$usuario = DB::CONNECTION('mysql')->table('students')
    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')
    ->select('students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))
  ->get();




  return response()->json(
   ['data' => $usuario]
);

}



    }



       public function myProject(Request $request)
    {
    $proyectoArray = array();
    $proyectoArray2 = array();

      if($request->ajax()){



      $info = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('tipo_proyecto', 'proyecto_investigacion.tipo_proyecto_id', '=', 'tipo_proyecto.tipo_proyecto_id')

   ->join('condicion_proyecto', 'proyecto_investigacion.condicion_proyecto_id', '=', 'condicion_proyecto.condicion_proyecto_id')

   ->join('estado_proyecto', 'proyecto_investigacion.estado_proyecto_id', '=', 'estado_proyecto.estado_proyecto_id')

   ->join('ulatina_carreras', 'proyecto_investigacion.id_carreras_ulatina', '=', 'ulatina_carreras.id_carreras_ulatina')

   ->select('proyecto_investigacion.*', 'tipo_proyecto.*', 'condicion_proyecto.*',

            'estado_proyecto.*', 'ulatina_carreras.*')
  ->get();

  //print_r($proyecto);

      $d = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


     $c = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $usuarios_proyecto = $c->merge($d);


 $proyectoParticipando = [];
 $encargadosTest = [];

try {

  $encargadosTest = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

   ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

    ->get();

    if (Count($encargadosTest)<1){

  }else{

     $proyectoParticipando = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('encargado_plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'encargado_plan_proyecto.proyecto_invetigacion_id')

   ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

   ->select('proyecto_investigacion.*')

    ->get();

  }


  if (is_null($proyectoParticipando)){
    print_r("expression") ;
  }else{


    foreach ($proyectoParticipando as $proyectoP) {

      array_push($proyectoArray, $proyectoP->proyecto_investigacion_id);

    }

  }


} catch (Exception $e) {

}






  foreach ($info as $proyecto) {


      foreach ($usuarios_proyecto as $usuario) {

        if($usuario->proyecto_investigacion_id==$proyecto->proyecto_investigacion_id && $usuario->id==auth()->user()->id){
                 array_push($proyectoArray, $proyecto->proyecto_investigacion_id);

                 if(auth()->user()->role_id==1){


               }else{

                if($usuario->tipo_usuario_proyecto_id!=2){
                  array_push($proyectoArray2, $proyecto->proyecto_investigacion_id);
                 }

               }
        }

      }


    }

  $resultado = array_unique($proyectoArray);

  $resultado2 = array_unique($proyectoArray2);

  return response()->json(
   ['data' => $info,
    'data2' => $usuarios_proyecto,
    'data3' => $resultado,
    'data4' => $resultado2]
);

}



    }




  public function allProject(Request $request)
    {
      if($request->ajax()){


      $info = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('tipo_proyecto', 'proyecto_investigacion.tipo_proyecto_id', '=', 'tipo_proyecto.tipo_proyecto_id')

   ->join('condicion_proyecto', 'proyecto_investigacion.condicion_proyecto_id', '=', 'condicion_proyecto.condicion_proyecto_id')

   ->join('estado_proyecto', 'proyecto_investigacion.estado_proyecto_id', '=', 'estado_proyecto.estado_proyecto_id')

   ->join('ulatina_carreras', 'proyecto_investigacion.id_carreras_ulatina', '=', 'ulatina_carreras.id_carreras_ulatina')

   ->select('proyecto_investigacion.*', 'tipo_proyecto.*', 'condicion_proyecto.*',

            'estado_proyecto.*', 'ulatina_carreras.*')
  ->get();

  //print_r($proyecto);

  // $usuarios_proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  //  ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

  //  ->join('person_profiles As users', 'usuario_proyecto.users_id', '=', 'users.id')

  //  ->join('person_profiles As users', 'usuario_proyecto.users_id', '=', 'users.id')

  //  ->select('proyecto_investigacion.proyecto_investigacion_id', 'usuario_proyecto.usuario_proyecto_id', 'usuario_proyecto.tipo_usuario_proyecto_id',

  //           'users.id', 'users.first_name AS name')

  //  ->get();



    $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


     $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $usuarios_proyecto = $a->merge($b);


    $proyectoArray = array();
    $proyectoArray2 = array();


        if(auth()->user()->role_id==1){


                foreach ($info as $proyecto) {


                array_push($proyectoArray, $proyecto->proyecto_investigacion_id);


                 }


        }else{


                  if(count($usuarios_proyecto)<1){



                    foreach ($info as $proyecto) {



                            if($proyecto->condicion_proyecto_id==2&&$proyecto->estado_proyecto_id==3){
                                    array_push($proyectoArray, $proyecto->proyecto_investigacion_id);
                            }



                  }





                  }else{


                  foreach ($info as $proyecto) {

                        foreach ($usuarios_proyecto as $usuario) {

                            if($usuario->proyecto_investigacion_id==$proyecto->proyecto_investigacion_id && $usuario->id==auth()->user()->id){
                                   array_push($proyectoArray, $proyecto->proyecto_investigacion_id);
                                   if($usuario->tipo_usuario_proyecto_id!=2){
                                    array_push($proyectoArray2, $proyecto->proyecto_investigacion_id);
                                   }
                            }else if($proyecto->condicion_proyecto_id==2&&$proyecto->estado_proyecto_id==3){
                                    array_push($proyectoArray, $proyecto->proyecto_investigacion_id);
                            }

                        }

                  }





                  }






                     $proyectoParticipando = [];
                     $encargadosTest = [];

                    try {

                      $encargadosTest = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

                       ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

                        ->get();

                        if (Count($encargadosTest)<1){

                      }else{

                         $proyectoParticipando = DB::CONNECTION('mysql')->table('proyecto_investigacion')

                       ->join('encargado_plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'encargado_plan_proyecto.proyecto_invetigacion_id')

                       ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

                       ->select('proyecto_investigacion.*')

                        ->get();

                      }


                      if (is_null($proyectoParticipando)){
                        print_r("expression") ;
                      }else{


                        foreach ($proyectoParticipando as $proyectoP) {

                          array_push($proyectoArray, $proyectoP->proyecto_investigacion_id);

                        }

                      }


                    } catch (Exception $e) {

                    }



              }

 $resultado = array_unique($proyectoArray);

 $resultado2 = array_unique($proyectoArray2);

  return response()->json(
   ['data' => $info,
    'data2' => $usuarios_proyecto,
    'data3' => $resultado,
    'data4' => $resultado2]
);



}
    }







      public function searchProject(Request $request)
    {
      if($request->ajax()){



        $strSearch = trim($request->get('searchText'));


      $info = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('tipo_proyecto', 'proyecto_investigacion.tipo_proyecto_id', '=', 'tipo_proyecto.tipo_proyecto_id')

   ->join('condicion_proyecto', 'proyecto_investigacion.condicion_proyecto_id', '=', 'condicion_proyecto.condicion_proyecto_id')

   ->join('estado_proyecto', 'proyecto_investigacion.estado_proyecto_id', '=', 'estado_proyecto.estado_proyecto_id')

   ->join('ulatina_carreras', 'proyecto_investigacion.id_carreras_ulatina', '=', 'ulatina_carreras.id_carreras_ulatina')

   ->join('sedes', 'proyecto_investigacion.sede_id', '=', 'sedes.id_sedes')

   ->where(DB::raw('UPPER (ulatina_carreras.nombre_carreras_ulatina)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (proyecto_investigacion.nombre_proyecto)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (sedes.nombre_sedes)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (tipo_proyecto.tipo_proyecto_descripcion)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (condicion_proyecto.condicion_proyecto_descripcion)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (estado_proyecto.estado_proyecto_descripcion)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->select('proyecto_investigacion.*', 'tipo_proyecto.*', 'condicion_proyecto.*',

            'estado_proyecto.*', 'ulatina_carreras.*')
  ->get();


  //print_r($proyecto);

    $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


     $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $usuarios_proyecto = $a->merge($b);





  $proyectoArray = array();
  $proyectoArray2 = array();



 $proyectoParticipando = [];
 $encargadosTest = [];

try {

  $encargadosTest = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

   ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

    ->get();

    if (Count($encargadosTest)<1){

  }else{

     $proyectoParticipando = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('encargado_plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'encargado_plan_proyecto.proyecto_invetigacion_id')

   ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

   ->select('proyecto_investigacion.*')

    ->get();

  }


  if (is_null($proyectoParticipando)){
    print_r("expression") ;
  }else{


    foreach ($proyectoParticipando as $proyectoP) {

      array_push($proyectoArray, $proyectoP->proyecto_investigacion_id);

    }

  }


} catch (Exception $e) {

}






  foreach ($info as $proyecto) {


      foreach ($usuarios_proyecto as $usuario) {

        if($usuario->proyecto_investigacion_id==$proyecto->proyecto_investigacion_id && $usuario->id==auth()->user()->id){
                 array_push($proyectoArray, $proyecto->proyecto_investigacion_id);

                 if(auth()->user()->role_id==1){


               }else{

                if($usuario->tipo_usuario_proyecto_id!=2){
                  array_push($proyectoArray2, $proyecto->proyecto_investigacion_id);
                 }

               }
        }

      }


    }

  $resultado = array_unique($proyectoArray);

  $resultado2 = array_unique($proyectoArray2);

  return response()->json(
   ['data' => $info,
    'data2' => $usuarios_proyecto,
    'data3' => $resultado,
    'data4' => $resultado2]
);


}
    }




  public function searchProjectAll(Request $request)
    {
      if($request->ajax()){

        $strM = strval($request->userId);

        $strSearch = trim($request->get('searchText'));


      $info = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('tipo_proyecto', 'proyecto_investigacion.tipo_proyecto_id', '=', 'tipo_proyecto.tipo_proyecto_id')

   ->join('condicion_proyecto', 'proyecto_investigacion.condicion_proyecto_id', '=', 'condicion_proyecto.condicion_proyecto_id')

   ->join('estado_proyecto', 'proyecto_investigacion.estado_proyecto_id', '=', 'estado_proyecto.estado_proyecto_id')

   ->join('ulatina_carreras', 'proyecto_investigacion.id_carreras_ulatina', '=', 'ulatina_carreras.id_carreras_ulatina')

   ->join('sedes', 'proyecto_investigacion.sede_id', '=', 'sedes.id_sedes')

   ->where(DB::raw('UPPER (ulatina_carreras.nombre_carreras_ulatina)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (proyecto_investigacion.nombre_proyecto)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (sedes.nombre_sedes)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (tipo_proyecto.tipo_proyecto_descripcion)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (condicion_proyecto.condicion_proyecto_descripcion)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->orwhere(DB::raw('UPPER (estado_proyecto.estado_proyecto_descripcion)'),'LIKE','%'.strtoupper($strSearch).'%')

   ->select('proyecto_investigacion.*', 'tipo_proyecto.*', 'condicion_proyecto.*',

            'estado_proyecto.*', 'ulatina_carreras.*')
  ->get();


  //print_r($proyecto);

    $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


     $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $usuarios_proyecto = $a->merge($b);





  $proyectoArray = array();
  $proyectoArray2 = array();



              if(auth()->user()->role_id==1){

              foreach ($info as $proyecto) {

                  array_push($proyectoArray, $proyecto->proyecto_investigacion_id);

              }

        }else{

            foreach ($info as $proyecto) {

                  foreach ($usuarios_proyecto as $usuario) {

                      if($usuario->proyecto_investigacion_id==$proyecto->proyecto_investigacion_id && $usuario->id==auth()->user()->id){
                             array_push($proyectoArray, $proyecto->proyecto_investigacion_id);
                             if($usuario->tipo_usuario_proyecto_id==3){
                              array_push($proyectoArray2, $proyecto->proyecto_investigacion_id);
                             }else if($usuario->tipo_usuario_proyecto_id==1){
                              array_push($proyectoArray2, $proyecto->proyecto_investigacion_id);
                             }

                      }else if($proyecto->condicion_proyecto_id==2&&$proyecto->estado_proyecto_id==3){
                              array_push($proyectoArray, $proyecto->proyecto_investigacion_id);
                      }

                  }

            }



          $proyectoParticipando = [];
           $encargadosTest = [];

          try {

            $encargadosTest = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

             ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

              ->get();

              if (Count($encargadosTest)<1){

            }else{

               $proyectoParticipando = DB::CONNECTION('mysql')->table('proyecto_investigacion')

             ->join('encargado_plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'encargado_plan_proyecto.proyecto_invetigacion_id')

             ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

             ->select('proyecto_investigacion.*')

              ->get();

            }


            if (is_null($proyectoParticipando)){
              print_r("expression") ;
            }else{


              foreach ($proyectoParticipando as $proyectoP) {

                array_push($proyectoArray, $proyectoP->proyecto_investigacion_id);

              }

            }


          } catch (Exception $e) {

          }


      }

  $resultado = array_unique($proyectoArray);

  $resultado2 = array_unique($proyectoArray2);

  return response()->json(
   ['data' => $info,
    'data2' => $usuarios_proyecto,
    'data3' => $resultado,
    'data4' => $resultado2]
);


}
    }


        public function consultarPlan(Request $request)
    {


      if($request->ajax()){

      $strM = strval($request->proyecto_investigacion_id);

      $planesT = DB::CONNECTION('mysql')->table('plan_proyecto')

                ->where('proyecto_investigacion_id','=', $strM)

                ->get();




        return response()->json(
         ['data' => $planesT]
      );

      }



    }


            public function consultarCantidadEstudiantes(Request $request)
    {


      if($request->ajax()){

      $strM = intval($request->proyecto_id);


      $strM2 = strval($request->fechaInicio);



      $strM3 = strval($request->fechaFin);


      $planesT = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

                ->where('proyecto_invetigacion_id','=', $strM)

                ->where('activo','=', 1)

                ->whereBetween('fecha_registro', [$strM2, $strM3])

                ->select(DB::raw('COUNT(encargado_plan_proyecto_id) as qtyEstudiantes'))

                ->get();


        return response()->json(
         ['data' => $planesT]
      );

      }



    }


    public function guardarEncargado(Request $request)
{


if($request->ajax()){

            $proyecto_invetigacion_id = intval($request->proyecto_invetigacion_id);


  DB::CONNECTION('mysql')->table('encargado_plan_proyecto')->insert(
    ['user_id' => auth()->user()->id,
    'activo' => 1,
    'fecha_registro' => date("Y-m-d"),
    'proyecto_invetigacion_id' => $proyecto_invetigacion_id]
);

  return response()->json();

}


}


//   public function validarParticipacion(Request $request)
//     {

//       if($request->ajax()){

//           $strM = strval($request->proyecto_investigacion_id);


//            $resultado = [];
//            $encargadosTest = [];
//            $planesT = [];


//           try {

//               $encargadosTest = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

//               ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

//               ->get();

//               if (Count($encargadosTest)<1){
//                 array_push($resultado, 'SI SE PUDO');

//                 $planesT = DB::CONNECTION('mysql')->table('plan_proyecto')

//                 ->where('proyecto_investigacion_id','=', $strM)

//                 ->get();

//                  if (Count($planesT)<1){
//                     array_push($resultado, 'YA CASI');
//                  }

//               }else{
//                 array_push($resultado, 'YA CASI');
//               }

//           } catch (Exception $e) {

//           }



//              return response()->json(
//                  ['data' => $resultado]
//               );



//       }

// }


  public function validarUsuarioPro(Request $request)
    {

      if($request->ajax()){

          $strM = strval($request->proyecto_invetigacion_id);



            $proyectoArray = array();
            $proyectoArray2 = array();



           $proyectoParticipando = [];
           $encargadosTest = [];

          try {

            $encargadosTest = DB::CONNECTION('mysql')->table('encargado_plan_proyecto')

             ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

              ->get();

              if (Count($encargadosTest)<1){

            }else{

               $proyectoParticipando = DB::CONNECTION('mysql')->table('proyecto_investigacion')

             ->join('encargado_plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'encargado_plan_proyecto.proyecto_invetigacion_id')

             ->where('encargado_plan_proyecto.user_id','=', auth()->user()->id)

             ->where('encargado_plan_proyecto.activo','=', 1)

             ->select('proyecto_investigacion.proyecto_investigacion_id', 'encargado_plan_proyecto.user_id As id')

              ->get();

            }


            if (is_null($proyectoParticipando)){
              print_r("expression") ;
            }else{


              foreach ($proyectoParticipando as $proyectoP) {

                array_push($proyectoArray, $proyectoP->id);

              }

            }


          } catch (Exception $e) {

          }




           $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

           ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

           ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

           ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

           ->where('proyecto_investigacion.proyecto_investigacion_id','=', $strM)

           ->where('admins.user_id','=', auth()->user()->id)

           ->select('proyecto_investigacion.proyecto_investigacion_id', 'admins.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

           ->get();


           $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

           ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

           ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

           ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

           ->where('proyecto_investigacion.proyecto_investigacion_id','=', $strM)

           ->where('students.user_id','=', auth()->user()->id)

           ->select('proyecto_investigacion.proyecto_investigacion_id', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

           ->get();


           $usuarios_proyecto = $a->merge($b);



            foreach ($usuarios_proyecto as $usuario) {

                if($usuario->id==auth()->user()->id){
                    array_push($proyectoArray, $usuario->id);
                }

            }


            foreach ($proyectoParticipando as $pp) {

                if($pp->id==auth()->user()->id){
                    array_push($proyectoArray2, $pp->id);
                }

            }

            $resultado = array_unique($proyectoArray);

            $resultado2 = array_unique($proyectoArray2);


             return response()->json(
                 ['data' => $resultado, 'data2' => $resultado2]
              );



      }

}






public function create(){

  $sedes = DB::CONNECTION('mysql')->table('sedes')->get();

  $carreras = DB::CONNECTION('mysql')->table('ulatina_carreras')->get();

  $tipo = DB::CONNECTION('mysql')->table('tipo_proyecto')->get();

  $estado = DB::CONNECTION('mysql')->table('estado_proyecto')->get();

    $profesores = DB::CONNECTION('mysql')->table('students')
    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')
    ->select('students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))
  ->get();

   return view("ModuloIE.Proyecto.create", ['sedes'=>$sedes, 'tipo'=>$tipo, 'estado'=>$estado, 'carreras'=>$carreras, 'profesores'=>$profesores]);

}

public function store(SedeFormRequest $request)
{
	$Sede  = new Sede;
	$Sede->DESCRIPCION = $request->get('DESCRIPCION');
	$Sede->save();
	return Redirect::to('ProyectoCiad/Sede/');
}


public function guardarProyecto(Request $request)
{



      $tabla = 'proyecto_investigacion';

if($request->ajax()){

            $nombre_proyecto = strval($request->nombre_proyecto);
            $justificacion = strval($request->justificacion);
            $tipo_proyecto_id = intval($request->tipo_proyecto_id);
            $condicion_proyecto_id = intval($request->condicion_proyecto_id);
            $metodologia = strval($request->metodologia);
            $presupuesto = floatval($request->presupuesto);
            $estado_proyecto_id = intval($request->estado_proyecto_id);
            $beneficiario = strval($request->beneficiario);
            $sede_id = intval($request->sede_id);
            $id_carreras_ulatina = strval($request->id_carreras_ulatina);
            $llaveAlmacenamiento = intval($request->llaveAlmacenamiento);

  DB::CONNECTION('mysql')->table('proyecto_investigacion')->insert([
    ['nombre_proyecto' => $nombre_proyecto,
    'justificacion' => $justificacion,
    'tipo_proyecto_id' => $tipo_proyecto_id,
    'condicion_proyecto_id' => $condicion_proyecto_id,
    'metodologia' => $metodologia,
    'presupuesto' => $presupuesto,
    'estado_proyecto_id' => $estado_proyecto_id,
    'beneficiario' => $beneficiario,
    'sede_id' => $sede_id,
    'llaveAlmacenamiento' => $llaveAlmacenamiento,
    'id_carreras_ulatina' => $id_carreras_ulatina]
]);


$proyectoInfo = DB::CONNECTION('mysql')->table($tabla)
->where('proyecto_investigacion.llaveAlmacenamiento','=',$llaveAlmacenamiento)
->orderBy('proyecto_investigacion_id', 'DESC')
->take(1)
->get();

  return response()->json($proyectoInfo);

}




}


public function modificarProyecto(Request $request)
{



      $tabla = 'proyecto_investigacion';

if($request->ajax()){

            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);
            $nombre_proyecto = strval($request->nombre_proyecto);
            $justificacion = strval($request->justificacion);
            $tipo_proyecto_id = intval($request->tipo_proyecto_id);
            $condicion_proyecto_id = intval($request->condicion_proyecto_id);
            $metodologia = strval($request->metodologia);
            $presupuesto = floatval($request->presupuesto);
            $estado_proyecto_id = intval($request->estado_proyecto_id);
            $beneficiario = strval($request->beneficiario);
            $sede_id = intval($request->sede_id);
            $id_carreras_ulatina = strval($request->id_carreras_ulatina);

  DB::CONNECTION('mysql')->table('proyecto_investigacion')
  ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)
  ->update(
    ['nombre_proyecto' => $nombre_proyecto,
    'justificacion' => $justificacion,
    'tipo_proyecto_id' => $tipo_proyecto_id,
    'condicion_proyecto_id' => $condicion_proyecto_id,
    'metodologia' => $metodologia,
    'presupuesto' => $presupuesto,
    'estado_proyecto_id' => $estado_proyecto_id,
    'beneficiario' => $beneficiario,
    'sede_id' => $sede_id,
    'id_carreras_ulatina' => $id_carreras_ulatina]
);



  return response()->json($proyectoInfo);

}




}


public function guardarUsuarioProyecto(Request $request)
{

    $tabla = 'usuario_proyecto';
if($request->ajax()){

            $users_id = intval($request->users_id);
            $tipo_usuario_proyecto_id = intval($request->tipo_usuario_proyecto_id);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);

    DB::CONNECTION('mysql')->table($tabla)->insert([[

    'users_id' => $users_id,
    'tipo_usuario_proyecto_id' => $tipo_usuario_proyecto_id,
    'proyecto_investigacion_id' => $proyecto_investigacion_id

    ]]);

  return response()->json('Saved');
}


}


public function guardarUsuarioProyectoProfeAdmin(Request $request)
{

    $tabla = 'usuario_proyecto';
if($request->ajax()){

            $propuestoid = intval($request->propuestoid);
            $responsable = intval($request->responsable);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);

    DB::CONNECTION('mysql')->table($tabla)->insert([[

    'users_id' => $propuestoid,
    'tipo_usuario_proyecto_id' => 3,
    'proyecto_investigacion_id' => $proyecto_investigacion_id

    ]]);

    DB::CONNECTION('mysql')->table($tabla)->insert([[

    'users_id' => $responsable,
    'tipo_usuario_proyecto_id' => 1,
    'proyecto_investigacion_id' => $proyecto_investigacion_id

    ]]);

  return response()->json('Saved');
}


}

public function modificarResponsableProyectoProfeAdmin(Request $request)
{

    $tabla = 'usuario_proyecto';
if($request->ajax()){


            $responsable = intval($request->responsable);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);



    $usuarioConsulta = DB::CONNECTION('mysql')->table('usuario_proyecto')
      ->where('usuario_proyecto.proyecto_investigacion_id', '=', $proyecto_investigacion_id)
      ->where('usuario_proyecto.tipo_usuario_proyecto_id', '=', 1)
      ->select('usuario_proyecto.*')
      ->get();

      if(count($usuarioConsulta)<1){


    DB::CONNECTION('mysql')->table('usuario_proyecto')->insert([[

    'users_id' => $responsable,
    'tipo_usuario_proyecto_id' => 1,
    'proyecto_investigacion_id' => $proyecto_investigacion_id

    ]]);


          $tabla = 'usuario_proyectoSI';

      }else{

          DB::CONNECTION('mysql')->table('usuario_proyecto')
          ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)
          ->where('tipo_usuario_proyecto_id', '=', 1)
          ->update([
          'users_id' => $responsable
          ]);


          $tabla = count($usuarioConsulta);

      }

  return response()->json($tabla);
}


}

public function guardarObjetivoGeneral(Request $request)
{

    $tabla = 'objetivo_proyecto';
if($request->ajax()){

            $objetivo_proyecto_descripcion = strval($request->objetivo_proyecto_descripcion);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);

    DB::CONNECTION('mysql')->table($tabla)->insert([

    'objetivo_proyecto_descripcion' => $objetivo_proyecto_descripcion,
    'objetivo_general' => 1,
    'estado_objetivo_id' => 2,
    'proyecto_investigacion_id' => $proyecto_investigacion_id

    ]);

  return response()->json('Saved');
}


}


public function modificarObjetivoGeneral(Request $request)
{

    $tabla = 'objetivo_proyecto';
if($request->ajax()){

            $objetivo_proyecto_descripcion = strval($request->objetivo_proyecto_descripcion);
            $proyecto_investigacion_id = strval($request->proyecto_investigacion_id);

    DB::CONNECTION('mysql')->table($tabla)
    ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)
    ->where('objetivo_general', '=', 1)
    ->update([

    'objetivo_proyecto_descripcion' => $objetivo_proyecto_descripcion

    ]);

  return response()->json('Saved');
}


}



public function guardarObjetivoEspecifico(Request $request)
{

    $tabla = 'objetivo_proyecto';
if($request->ajax()){

            $objetivo_proyecto_id = strval($request->objetivo_proyecto_id);
            $objetivo_proyecto_descripcion = strval($request->objetivo_proyecto_descripcion);
            $objetivo_general = intval($request->objetivo_general);
            $estado_objetivo_id = intval($request->estado_objetivo_id);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);

    DB::CONNECTION('mysql')->table($tabla)->insert([[

    'objetivo_proyecto_descripcion' => $objetivo_proyecto_descripcion,
    'objetivo_general' => $objetivo_general,
    'estado_objetivo_id' => $estado_objetivo_id,
    'proyecto_investigacion_id' => $proyecto_investigacion_id

    ]]);

  return response()->json('Saved');
}


}

public function modificarObjetivoEspecifico(Request $request)
{

    $tabla = 'objetivo_proyecto';
if($request->ajax()){

            $objetivo_proyecto_id = strval($request->objetivo_proyecto_id);
            $objetivo_proyecto_descripcion = strval($request->objetivo_proyecto_descripcion);

    DB::CONNECTION('mysql')->table($tabla)
    ->where('objetivo_proyecto_id', '=', $objetivo_proyecto_id)
    ->update([

    'objetivo_proyecto_descripcion' => $objetivo_proyecto_descripcion

    ]);

  return response()->json('Saved');
}


}

public function eliminarObjetivoEspecifico(Request $request)
{

    $tabla = 'objetivo_proyecto';
if($request->ajax()){

            $objetivo_proyecto_id = intval($request->objetivo_proyecto_id);

    DB::CONNECTION('mysql')->table($tabla)
    ->where('objetivo_proyecto_id', '=', $objetivo_proyecto_id)
    ->delete();

  return response()->json('Saved');
}


}


public function eliminarObjetivosPlan(Request $request)
{

if($request->ajax()){

    $objetivo_plan_proyecto_id = intval($request->objetivo_plan_proyecto_id);

    $queryObservacionesObjetivoPlan = DB::CONNECTION('mysql')->table('observacion_objetivo_plan')
    ->where('objetivo_plan_proyecto_id', '=', $objetivo_plan_proyecto_id)
    ->get();

if(count($queryObservacionesObjetivoPlan)<1){

DB::CONNECTION('mysql')->table('observacion_objetivo_plan')
    ->where('objetivo_plan_proyecto_id', '=', $objetivo_plan_proyecto_id)
    ->delete();

}


    DB::CONNECTION('mysql')->table('objetivo_asignado')
    ->where('objetivo_plan_proyecto_id', '=', $objetivo_plan_proyecto_id)
    ->delete();

    DB::CONNECTION('mysql')->table('objetivo_plan_proyecto')
    ->where('objetivo_plan_proyecto_id', '=', $objetivo_plan_proyecto_id)
    ->delete();

  return response()->json('Saved');
}


}


public function eliminarPlan(Request $request)
{

if($request->ajax()){

    $plan_id = intval($request->plan_id);


    $usuarioConsulta = DB::CONNECTION('mysql')->table('objetivo_plan_proyecto')
    ->where('plan_proyecto_id', '=', $plan_id)
    ->get();


    if(count($usuarioConsulta)<1)
    {

    }else{

    foreach ($usuarioConsulta as $key) {

    DB::CONNECTION('mysql')->table('observacion_objetivo_plan')
    ->where('objetivo_plan_proyecto_id', '=', $key->objetivo_plan_proyecto_id)
    ->delete();

    DB::CONNECTION('mysql')->table('objetivo_asignado')
    ->where('objetivo_plan_proyecto_id', '=', $key->objetivo_plan_proyecto_id)
    ->delete();

    DB::CONNECTION('mysql')->table('objetivo_plan_proyecto')
    ->where('objetivo_plan_proyecto_id', '=', $key->objetivo_plan_proyecto_id)
    ->delete();
      # code...
    }


    }



     DB::CONNECTION('mysql')->table('plan_proyecto')
    ->where('plan_proyecto_id', '=', $plan_id)
    ->delete();


  return response()->json('Saved');
}

}


public function guardarColaborador(Request $request)
{

    $tabla = 'usuario_proyecto';
if($request->ajax()){

            $users_id = intval($request->users_id);
            $tipoUsuario = intval($request->tipo_usuario_proyecto_id);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);

    DB::CONNECTION('mysql')->table($tabla)->insert([[

    'users_id' => $users_id,
    'tipo_usuario_proyecto_id' => $tipoUsuario,
    'proyecto_investigacion_id' => $proyecto_investigacion_id

    ]]);


  return response()->json('Saved');
}


}


public function eliminarColaborador(Request $request)
{

    $tabla = 'usuario_proyecto';
if($request->ajax()){

            $usuario_proyecto_id = intval($request->usuario_proyecto_id);

    DB::CONNECTION('mysql')->table($tabla)
    ->where('usuario_proyecto_id', '=', $usuario_proyecto_id)
    ->delete();


  return response()->json('Saved');
}


}


public function eliminarUsuarioAsignado(Request $request)
{

    $tabla = 'objetivo_asignado';
    if($request->ajax()){

                $objetivo_asignado_id = intval($request->objetivo_asignado_id);

        DB::CONNECTION('mysql')->table($tabla)
        ->where('objetivo_asignado_id', '=', $objetivo_asignado_id)
        ->delete();


      return response()->json('Saved');
    }


}


public function guardarObservaciones(Request $request)
{

    $tabla = 'observacion_proyecto';
if($request->ajax()){

            $observacion_proyecto_descripcion = strval($request->observacion_proyecto_descripcion);
            $proyecto_investigacion_id = intval($request->proyecto_investigacion_id);

    DB::CONNECTION('mysql')->table($tabla)->insert([

    'observacion_proyecto_descripcion' => $observacion_proyecto_descripcion,
    'proyecto_investigacion_id' => $proyecto_investigacion_id

    ]);


  return response()->json('Saved');
}


}

public function modificarObservaciones(Request $request)
{

    $tabla = 'observacion_proyecto';
if($request->ajax()){

            $observacion_proyecto_id = intval($request->observacion_proyecto_id);
            $observacion_proyecto_descripcion = strval($request->observacion_proyecto_descripcion);

    DB::CONNECTION('mysql')->table($tabla)
    ->where('observacion_proyecto_id', '=', $observacion_proyecto_id)
    ->update([

    'observacion_proyecto_descripcion' => $observacion_proyecto_descripcion

    ]);


  return response()->json('Saved');
}


}


public function modificarObservacionesObjetivo(Request $request)
{

    $tabla = 'observacion_proyecto';
if($request->ajax()){

            $observacion_objetivo_plan_id = intval($request->observacion_objetivo_plan_id);
            $observacion_objetivo_plan_descripcion = strval($request->observacion_objetivo_plan_descripcion);


  DB::CONNECTION('mysql')->table('observacion_objetivo_plan')
  ->where('observacion_objetivo_plan_id', '=', $observacion_objetivo_plan_id)
  ->update(
    ['observacion_objetivo_plan_descripcion' => $observacion_objetivo_plan_descripcion]
);


  return response()->json('Saved');
}


}


public function eliminarObservacion(Request $request)
{

    if($request->ajax()){

        $observacion_proyecto_id = intval($request->observacion_proyecto_id);

        DB::CONNECTION('mysql')->table('observacion_proyecto')
        ->where('observacion_proyecto_id', '=', $observacion_proyecto_id)
        ->delete();


      return response()->json('Saved');
    }

}



public function consultarProyectoAlmacenado(Request $request)
{

    $tabla = 'proyecto_investigacion';
if($request->ajax()){

            $llaveAlmacenamiento = strval($request->llaveAlmacenamiento);

              $proyecto = DB::CONNECTION('mysql')->table($tabla)
              ->where('llaveAlmacenamiento', '=', $llaveAlmacenamiento)
              ->orderBy('proyecto_investigacion_id', 'DESC')
              ->get(['proyecto_investigacion_id']);

             return response()->json($llaveAlmacenamiento);
}


}



public function show($COD_SEDE){
	return view("Ciad.Sede.show",["Sede"=>Sede::findOrFail($COD_SEDE)]);
}




public function edit($proyecto_investigacion_id){

	  $sedes = DB::CONNECTION('mysql')->table('sedes')->get();

  $carreras = DB::CONNECTION('mysql')->table('ulatina_carreras')->get();

  $tipo = DB::CONNECTION('mysql')->table('tipo_proyecto')->get();

  $estado = DB::CONNECTION('mysql')->table('estado_proyecto')->get();

  $Proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

              ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)

              ->select('proyecto_investigacion.*')

              ->first();



  $proyectoId = $Proyecto->proyecto_investigacion_id;

  $objetivosP = DB::CONNECTION('mysql')->table('objetivo_proyecto')

  ->where('proyecto_investigacion_id','=',''.$proyectoId.'')

  ->get();



  $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',''.$proyectoId.'')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


     $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',''.$proyectoId.'')

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $usuariosP = $a->merge($b);



  $observaciones = DB::CONNECTION('mysql')->table('observacion_proyecto')

  ->where('proyecto_investigacion_id','=',''.$proyectoId.'')

  ->get();


  $systemUsers = DB::CONNECTION('mysql')->table('students')
    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')
    ->select('students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))
  ->get();



   return view("ModuloIE.Proyecto.edit", ['Proyecto'=>$Proyecto,'sedes'=>$sedes, 'tipo'=>$tipo, 'estado'=>$estado, 'carreras'=>$carreras, 'objetivosP'=>$objetivosP, 'usuariosP'=>$usuariosP, 'observaciones'=>$observaciones, 'systemUsers'=>$systemUsers]);


}



public function indexPlanTrabajo($proyecto_investigacion_id){


    $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)

  ->select('proyecto_investigacion.*')

  ->first();

  return view('ModuloIE.PlanDeTrabajo.index', ['proyecto'=>$proyecto]);


}


public function indexObjetivosPlanTrabajo($proyecto_investigacion_id, $plan_proyecto_id){


    $proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

  ->join('plan_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'plan_proyecto.proyecto_investigacion_id')

  ->where('proyecto_investigacion.proyecto_investigacion_id', '=', $proyecto_investigacion_id)

  ->where('plan_proyecto.plan_proyecto_id', '=', $plan_proyecto_id)

  ->select('proyecto_investigacion.*', 'plan_proyecto.*')

  ->first();

  return view('ModuloIE.ObjetivoPlan.index', ['proyecto'=>$proyecto]);


}





public function participar($proyecto_investigacion_id){

    $sedes = DB::CONNECTION('mysql')->table('sedes')->get();

  $carreras = DB::CONNECTION('mysql')->table('ulatina_carreras')->get();

  $tipo = DB::CONNECTION('mysql')->table('tipo_proyecto')->get();

  $estado = DB::CONNECTION('mysql')->table('estado_proyecto')->get();

  $Proyecto = DB::CONNECTION('mysql')->table('proyecto_investigacion')

              ->where('proyecto_investigacion_id', '=', $proyecto_investigacion_id)

              ->select('proyecto_investigacion.*')

              ->first();
  //aqui me da error non objetct on property proyecto_investigacion_id
  //$proyectoId = $Proyecto->proyecto_investigacion_id;

  $objetivosP = DB::CONNECTION('mysql')->table('objetivo_proyecto')

  ->where('proyecto_investigacion_id','=',$proyecto_investigacion_id)

  ->get();




   $b = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('admins', 'usuario_proyecto.users_id', '=', 'admins.user_id')

   ->join('person_profiles As users', 'admins.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',$proyecto_investigacion_id)

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'admins.user_Id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


     $a = DB::CONNECTION('mysql')->table('proyecto_investigacion')

   ->join('usuario_proyecto', 'proyecto_investigacion.proyecto_investigacion_id', '=', 'usuario_proyecto.proyecto_investigacion_id')

   ->join('students', 'usuario_proyecto.users_id', '=', 'students.user_id')

   ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')

   ->where('proyecto_investigacion.proyecto_investigacion_id','=',$proyecto_investigacion_id)

   ->select('proyecto_investigacion.*', 'usuario_proyecto.*', 'students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))

  ->get();


  $usuariosP = $a->merge($b);



  $observaciones = DB::CONNECTION('mysql')->table('observacion_proyecto')

  ->where('proyecto_investigacion_id','=',$proyecto_investigacion_id)

  ->get();



  $systemUsers = DB::CONNECTION('mysql')->table('students')
    ->join('person_profiles As users', 'students.person_profile_id', '=', 'users.id')
    ->select('students.user_id As id', DB::raw('CONCAT(users.first_name, " ", users.last_name1, " ", users.last_name2) As name'))
  ->get();




   return view("ModuloIE.Proyecto.participar", ['Proyecto'=>$Proyecto,'sedes'=>$sedes, 'tipo'=>$tipo, 'estado'=>$estado, 'carreras'=>$carreras, 'objetivosP'=>$objetivosP, 'usuariosP'=>$usuariosP, 'observaciones'=>$observaciones, 'systemUsers'=>$systemUsers]);


}



public function update(SedeFormRequest $request, $proyecto_investigacion_id){
	$Proyecto=Investigacion::findOrFail($proyecto_investigacion_id);
	$Proyecto->proyecto_nombre = $request->get('proyecto_nombre');
	$Proyecto->update();
	return Redirect::to('ProyectoCiad/Sede');
}

public function excel(Request $request, $DESCRIPCION)
    {

    	if ($request){

if ($DESCRIPCION=="*"){
  $sede_data = DB::table('sedes_tb')
  ->orderBy('COD_SEDE','asc')->get();
}
else{
    $sede_data = DB::table('sedes_tb')
  ->where('DESCRIPCION','LIKE','%'.$DESCRIPCION.'%')
  ->orwhere('COD_SEDE','LIKE','%'.$DESCRIPCION.'%')
  ->orderBy('COD_SEDE','asc')->get();
}

     $query = trim($request->get('searchText'));
     $sede_array[] = array('ID SEDE', 'SEDE');
     foreach($sede_data as $customer)
     {
      $sede_array[] = array(
       'ID SEDE'  => $customer->COD_SEDE,
       'SEDE'   => $customer->DESCRIPCION
      );
     }
     return Excel::create('Sedes Data', function($excel) use ($sede_array){
      $excel->setTitle('Sedes Data');
      $excel->sheet('Sedes Data', function($sheet) use ($sede_array){
       $sheet->fromArray($sede_array, null, 'A1', false, false);
      });
     })->download('xlsx');

}


    }

    public function csvFormat(Request $request, $DESCRIPCION)
    {

    	if ($request){

if ($DESCRIPCION=="*"){
  $sede_data = DB::table('sedes_tb')
  ->orderBy('COD_SEDE','asc')->get();
}
else{
    $sede_data = DB::table('sedes_tb')
  ->where('DESCRIPCION','LIKE','%'.$DESCRIPCION.'%')
  ->orwhere('COD_SEDE','LIKE','%'.$DESCRIPCION.'%')
  ->orderBy('COD_SEDE','asc')->get();
}

     $query = trim($request->get('searchText'));

     $sede_array[] = array('ID SEDE', 'SEDE');
     foreach($sede_data as $customer)
     {
      $sede_array[] = array(
       'ID SEDE'  => $customer->COD_SEDE,
       'SEDE'   => $customer->DESCRIPCION
      );
     }
     return Excel::create('Sedes Data', function($excel) use ($sede_array){
      $excel->setTitle('Sedes Data');
      $excel->sheet('Sedes Data', function($sheet) use ($sede_array){
       $sheet->fromArray($sede_array, null, 'A1', false, false);
      });
     })->download('csv');

}


    }

      public function exportPDF(Request $request, $DESCRIPCION)

  {
  if ($DESCRIPCION=="*"){
  $sede_data = DB::table('sedes_tb')
  ->orderBy('COD_SEDE','asc')->get();
}
else{
    $sede_data = DB::table('sedes_tb')
  ->where('DESCRIPCION','LIKE','%'.$DESCRIPCION.'%')
  ->orwhere('COD_SEDE','LIKE','%'.$DESCRIPCION.'%')
  ->orderBy('COD_SEDE','asc')->get();
}
$sede_array[] = array('ID SEDE', 'SEDE');
     foreach($sede_data as $customer)
     {
      $sede_array[] = array(
       'ID SEDE'  => $customer->COD_SEDE,
       'SEDE'   => $customer->DESCRIPCION
      );
     }
     return Excel::create('itsolutionstuff_example', function($excel) use ($sede_array) {

    $excel->sheet('mySheet', function($sheet) use ($sede_array)

      {

      $sheet->fromArray($sede_array);

      });

     })->download("pdf");

  }






public function destroy($proyecto_investigacion_id){
	    // $Facultad=Categoria::findOrFail($COD_FACULTAD);
     //    $Facultad->condicion='0';
     //    $Facultad->update();

	    $ProyectoDestroy = Investigacion::findOrFail($proyecto_investigacion_id);
      $ProyectoDestroy->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted the nerd!');
        //return Redirect::to('nerds');
        return Redirect::to('/ModuloIE/Proyecto/');
}

public function about(){
	return view("acercaDeNosotros");
}

}
