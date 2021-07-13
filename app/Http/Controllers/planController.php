<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\planRequest;

use App\Models\Investigacion;
use App\Models\Planes;

// agregar los otros modelos despues
use App\BL\InvestigationBL;

use Illuminate\Support\Facade\Redirect;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use DB;

class planController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }   
   
    public function create(Request $request){
       return 'create';
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(planRequest $request, $id){
       // $investigaciones = Investigacion::find($id);
     //  dd("hola");
        if (InvestigationBL::createPlan($request->all(), $id)) {
            //return redirect('investigation/plan')->with('sucess', 'Plan creado exitosamente');
            $plan = Planes::where('investigaciones_id_investigaciones',$id)->first();
            $idP = $plan->id_planes;
            $investigaciones = Investigacion::find($plan->investigaciones_id_investigaciones);
            $objePlan = DB::select('select * from obejtivos_planes, obejtivos_planes_users, users  where planes_id_planes = '.$idP.' and 
            obejtivos_planes_id_obejtivos_planes = id_obejtivos_planes and users_id = id');
            return view('investigation/showPlan',["objePlan" => $objePlan, "investigaciones"=>$investigaciones])->with('sucess', 'Objetivo creado exitosamente');
        }

        return redirect('investigation/plan')->with('error', 'El plan no puedo ser careado');


    }
    public function update(planRequest $request, $id, $idObj){

       
       $result = InvestigationBL::updateObje($request->all(), $id, $idObj);
       
        if ($result) {
            $investigaciones = Investigacion::find($id);
            //dd($investigaciones);
            $plan = Planes::where('id_planes',$id)->first();
            //dd($plan);
            $idP = $plan->id_planes;
            $investigaciones = Investigacion::find($plan->investigaciones_id_investigaciones);
            $objePlan = DB::select('select * from obejtivos_planes, obejtivos_planes_users, users  where planes_id_planes = '.$idP.' and 
            obejtivos_planes_id_obejtivos_planes = id_obejtivos_planes and users_id = id');
            
     
            return view('investigation/showPlan',["objePlan" => $objePlan, "investigaciones"=>$investigaciones])->with('sucess', 'Objetivo actualizado de manera correcta');
            /*$investigaciones = Investigacion::find($id);
            $estado = DB::table('investigacion_estados')->where('investigaciones_id_investigaciones',$id)->where('indicador_estados',1)->first();
            $planes = Planes::where('id_planes',$id)->first();
            $users_invest = DB::select('select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = '.$planes->investigaciones_id_investigaciones.' and users_id = id');
            $users_resp = DB::select("select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = ".$planes->investigaciones_id_investigaciones." and users_id = id and tipo_participaciones = 'responsable'");
            $objeEspe = DB::select('select * from obejtivos_planes where id_obejtivos_planes = '.$idObj);
            //dd($objeEspe);
            $colaboradores = DB::select('select * from obejtivos_planes_users, users where obejtivos_planes_id_obejtivos_planes = '.$idObj.' and users_id = id');
            $sucess = 'Objetivo actualizado de manera correcta';
            return view('investigation.plan',["investigaciones"=>$investigaciones,
                                                "planes" => $planes,
                                                "users_invest" =>$users_invest,
                                                "objeEspe"=>$objeEspe,
                                                "colaboradores"=>$colaboradores, 
                                                "users_resp" => $users_resp,
                                                "sucess"=>$sucess ])->with('sucess', 'Cambios guardados correctamente.');*/
            //return redirect('investigation/create')->with('sucess', 'Cambios guardados correctamente.');
        }

        return redirect('investigation/create')->with('error', 'Los datos no pudieron ser guardados.');
    }
    public function edit($id, $idObj){
        $investigaciones = Investigacion::find($id);
        $estado = DB::table('investigacion_estados')->where('investigaciones_id_investigaciones',$id)->where('indicador_estados',1)->first();
        $planes = Planes::where('id_planes',$id)->first();
        $users_invest = DB::select('select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = '.$planes->investigaciones_id_investigaciones.' and users_id = id');
        $users_resp = DB::select("select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = ".$planes->investigaciones_id_investigaciones." and users_id = id and tipo_participaciones = 'responsable'");
        $objeEspe = DB::select('select * from obejtivos_planes where id_obejtivos_planes = '.$idObj);
        //dd($objeEspe);
        $colaboradores = DB::select('select * from obejtivos_planes_users, users where obejtivos_planes_id_obejtivos_planes = '.$idObj.' and users_id = id');
        
        return view('investigation.plan',["investigaciones"=>$investigaciones,
                                          "planes" => $planes,
                                          "users_invest" =>$users_invest,
                                          "users_resp" => $users_resp,
                                          "objeEspe"=>$objeEspe,
                                          "colaboradores"=>$colaboradores]);
     }
    public function destroy($id){
       // 
       $objeEspe = DB::select('select * from obejtivos_planes where id_obejtivos_planes = '.$id); 
        $plan = Planes::where('id_planes',$objeEspe[0]->planes_id_planes)->first();
       // dd($plan);
        $idP = $plan->id_planes;
         $investigaciones = Investigacion::find($plan->investigaciones_id_investigaciones);
        if (InvestigationBL::deleteObj($id)) {
            // $investigaciones = Investigacion::all();
            
            $objePlan = DB::select('select * from obejtivos_planes, obejtivos_planes_users, users  where planes_id_planes = '.$idP.' and 
            obejtivos_planes_id_obejtivos_planes = id_obejtivos_planes and users_id = id');
            $sucess = 'Objetivo eliminado exitosamente';
     
            return view('investigation/showPlan',["objePlan" => $objePlan, "investigaciones"=>$investigaciones, "sucess"=>$sucess])->with('sucess', 'Objetivo eliminado exitosamente');
        
         }
         $investigaciones = Investigacion::all();
         return view('investigation/index',["investigaciones"=>$investigaciones])->with('error', 'La investigacion no puedo ser eliminada, todos los usuarios deben estar registrados');

    }

}
