<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Investigacion;
use App\Models\Objetivos_especificos;
use App\Models\Investigacion_estados;
use App\Models\Planes;
use App\Models\Objetivos_planes;
use App\Models\Objetivos_planes_users;
use App\Models\Estado_observaciones;
use App\Models\Investigaciones_usuarios;
// agregar los otros modelos despues
use App\BL\InvestigationBL;

use Illuminate\Support\Facade\Redirect;
use App\Http\Requests\InvestigationFormRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use DB;


class InvestigationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $investigaciones = DB::select("select * from investigaciones, investigaciones_usuarios, users");
        return view('investigation.index',["investigaciones"=>$investigaciones]);
    }

    public function myInvest()
    {
        $user = Auth::user()->id;
        $investigaciones = DB::select("select * from investigaciones, investigaciones_usuarios, users where
                    investigaciones_id_investigaciones = id_investigaciones and users_id = id and users_id = ".$user);
        return view('investigation.index',["investigaciones"=>$investigaciones]);

    }
    public function create(Request $request)
    {
        $role = Auth::user()->role_id;
        $user = Auth::user()->id;
        $band_user=0;
        if($request->get('idInv')){
            $id = $request->get('idInv');
            $investigaciones = Investigacion::find($id);
            
            $objeEspes = DB::select('select * from objetivos_especificos where investigaciones_id_investigaciones ='.$id );
            
            $estado = DB::table('investigacion_estados')->where('investigaciones_id_investigaciones',$id)->where('indicador_estados',1)->first();
            $observaciones = DB::select('select * from estado_observaciones where investigacion_estados_id_investigacion_estados ='.$estado->id_investigacion_estados);
           
            $users_invest = DB::select("select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = ".$id." and users_id = id and tipo_participaciones = 'colaborador'");
            $users_cola = DB::select("select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = ".$id." and users_id = id and tipo_participaciones = 'responsable'");
            $setUser = DB::select('select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = '.$id.' and users_id = '.$user.' and id = '.$user);
           
            if ($setUser){
                if($setUser[0]->tipo_participaciones == 'colaborador'){
                    $band_user = 2;
                }else{
                    $band_user = 1;
                }
            }
            
            return view('investigation.create',["investigaciones"=>$investigaciones,
                                                "objeEspes"=>$objeEspes,
                                                 "estado"=>$estado, 
                                                 "observaciones"=>$observaciones,
                                                 "users_invest" =>$users_invest, 
                                                 "users_cola" =>$users_cola,
                                                 "role"=>$role,
                                                 "band_user"=>$band_user]);
        }else{
            $band_user = 1;
            return view('investigation.create', ["role"=>$role, "band_user"=>$band_user]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvestigationFormRequest $request)
    {
        if (InvestigationBL::createInvest($request->all())) {
            $user = Auth::user()->id;
            $sucess = "Proyecto propuesto de manera correcta";
            $investigaciones = DB::select("select * from investigaciones, investigaciones_usuarios, users where
                    investigaciones_id_investigaciones = id_investigaciones and users_id = id and users_id = ".$user);
            return view('investigation/index',["investigaciones"=>$investigaciones,  "sucess"=>$sucess])->with('sucess', 'Proyecto propuesto de manera correcta');
        }

        return redirect('investigation/create')->with('error', 'La investigacion no puedo ser creada, todos los usuarios deben estar registrados');
    }
    public function participar($idInvest)
    {
        $user = Auth::user()->id;
        $investigaciones = DB::select("select * from investigaciones, investigaciones_usuarios, users where
                    investigaciones_id_investigaciones = id_investigaciones and users_id = id and users_id = ".$user);
        if (InvestigationBL::participa($idInvest)) {
            $sucess = 'Participación exitosa en el proyecto';
            return view('investigation/index',["investigaciones"=>$investigaciones, "sucess"=>$sucess])->with('sucess', 'Participación exitosa en el proyecto');
        }else{
            return view('investigation/create')->with('error', 'No se pudo completar la participación en el proyecto');
        }       
    }

    public function show()
    {
        return view('investigation.index');
    }

    public function plan(Request $request)
    {
        $id = $request->get('id');
        
        $investigaciones = Investigacion::find($id);
        $estado = DB::table('investigacion_estados')->where('investigaciones_id_investigaciones',$id)->where('indicador_estados',1)->first();
        $planes = Planes::where('investigaciones_id_investigaciones',$id)->first();
        if($id){
            $users_invest = DB::select('select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = '.$request->get('id').' and users_id = id');
            $users_resp = DB::select("select * from investigaciones_usuarios, users where investigaciones_id_investigaciones = ".$request->get('id')." and users_id = id and tipo_participaciones = 'responsable'");
            return view('investigation.plan',["investigaciones"=>$investigaciones, "planes" => $planes, "users_invest" =>$users_invest, "users_resp"=>$users_resp]);
        }else{
            return view('investigation.plan',["investigaciones"=>$investigaciones, "planes" => $planes]);
        }
    }
   
    public function showPlan(Request $request)
    {    
        $objePlan = DB::select('select * from obejtivos_planes, obejtivos_planes_users, users  where planes_id_planes = '.$request->get('id').' and 
            obejtivos_planes_id_obejtivos_planes = id_obejtivos_planes and users_id = id');
        if($objePlan)
        { 
            $plan = Planes::where('id_planes',$objePlan[0]->planes_id_planes)->first();
            $investigaciones = Investigacion::find($plan->investigaciones_id_investigaciones);
            if ($request->get('band')!= 1)
                return view('investigation.showPlan',["objePlan"=>$objePlan, "investigaciones"=>$investigaciones]);
            else
            {
                $objeEspe = DB::select('select * from obejtivos_planes where id_obejtivos_planes = '.$request->get('idObj'));
                $colaboradores = DB::select('select * from obejtivos_planes_users, users where obejtivos_planes_id_obejtivos_planes ='.$request->get('idObj').' and users_id = id');
             
                return view('investigation.showPlan',["objePlan"=>$objePlan, "objeEspe" =>$objeEspe, "colaboradores"=>$colaboradores, "investigaciones"=>$investigaciones]);
            }
        }
        else
            return view('investigation.showPlan');
    }
    public function edit()
    {
        return 'edit';
    }

    public function update(InvestigationFormRequest $request, $id)
    {  
       $role = Auth::user()->role_id;
       $user = Auth::user()->id;
       $band_user = 0;
       $result = InvestigationBL::updateInvest($request->all(), $id);

        if ($result) 
        {
            $user = Auth::user()->id;
            $sucess = "Proyecto actualizado de manera correcta";
            $investigaciones = DB::select("select * from investigaciones, investigaciones_usuarios, users where
                    investigaciones_id_investigaciones = id_investigaciones and users_id = id and users_id = ".$user);
            return view('investigation/index',["investigaciones"=>$investigaciones, "sucess"=>$sucess])->with('sucess', 'Proyecto actualizado de manera correcta');
        }
        return redirect('investigation/create', ["role"=>$role, "band_user"=> $band_user])->with('error', 'Los datos no pudieron ser guardados.');
    }

    public function destroy($id)
    {
        if (InvestigationBL::deleteInvest($id)) 
        {
            $user = Auth::user()->id;
            $investigaciones = DB::select("select * from investigaciones, investigaciones_usuarios, users where
                    investigaciones_id_investigaciones = id_investigaciones and users_id = id and users_id = ".$user);
            return view('investigation/index',["investigaciones"=>$investigaciones])->with('sucess', 'Proyecto eliminado correctamente.');
        }
        $investigaciones = Investigacion::all();
        return view('investigation/index',["investigaciones"=>$investigaciones])->with('error', 'La investigacion no puedo ser eliminada, todos los usuarios deben estar registrados');
    }
}
