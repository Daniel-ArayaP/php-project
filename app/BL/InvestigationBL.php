<?php

namespace App\BL;

use App\Models\Investigacion;
use App\Models\PersonProfile;
use App\Models\Student;
use App\Models\Investigaciones_usuarios;
use App\Models\Investigacion_estados;
use App\Models\Objetivos_especificos;
use App\Models\Estado_observaciones;
use App\Models\User;
use App\Models\Planes;
use App\Models\Objetivos_planes;
use App\Models\Objetivos_planes_users;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectStatusChanged;


class InvestigationBL
{
    public static function createInvest(array $data) 
    {
        DB::beginTransaction();
        //dd($data);
        $role = Auth::user()->role_id;
        try
		{   
            foreach($data['colaboradores'] as $users){
                $user = User::where('email',$users)->first();
               // dd($user);
                if(!$user){
                    return false;
                }
            }
            $userR = Auth::user()->id;
            $tipo_invest;
            $publicado = 0;
            if($role == 1){
                if ($data['publicado']=='on'){
                    $publicado = 1;
                }
            }
            
            if ($data['beneficiario']){
                $tipo_invest = 'Extension';
            }else{
                $tipo_invest = 'Investigacion';
            }
            $sede;
            $sede2;
            if($data['sedes'] == 'San Pedro'){
                $sede = 1;
                $sede2 = 'San Pedro';
            }
            if($data['sedes'] == 'Heredia'){
                $sede = 2;
                $sede2 = 'Heredia';
            }
            if($data['sedes'] == 'Guápiles'){
                $sede = 3;
                $sede2 = 'GuÃ¡piles';
            }
            if($data['sedes'] == 'Pérez Zeledón'){
                $sede = 4;
                $sede2 = 'Perez ZelÃ©don';
            }
            if($data['sedes'] == 'Santa Cruz'){
                $sede = 5;
                $sede2 = 'Santa Cruz';
            }
            if($data['sedes'] == 'Grecia'){
                $sede = 6;
                $sede2 = 'Grecia';
            }
            if ($role == 1){
                $investigacion = Investigacion::create([
                    'nombre_investigaciones' => $data['nombre'],
                    'justificacion_investigaciones' => $data['justificacion'],
                    'tipo_investigaciones' => $tipo_invest,
                    'publicado_investigaciones' => $publicado,
                    'metodologia_investigaciones' => $data['metodologia'],
                    'presupuesto_investigaciones' => $data['presupuesto'],
                    'objetivo_gnrl_investigaciones' => $data['obj-gnrl'],
                    'sedes_id_sedes' => $sede,
                    'sedes_nombre_sedes' => $sede2,
                    'beneficiario_investigaciones' => $data['beneficiario']
                ]);
            }else {
                $investigacion = Investigacion::create([
                    'nombre_investigaciones' => $data['nombre'],
                    'justificacion_investigaciones' => $data['justificacion'],
                    'tipo_investigaciones' => $tipo_invest,
                    'publicado_investigaciones' => 0,
                    'objetivo_gnrl_investigaciones' => $data['obj-gnrl'],
                    'sedes_id_sedes' => $sede,
                    'sedes_nombre_sedes' => $sede2,
                    'beneficiario_investigaciones' => $data['beneficiario']
                ]);
            }
			
            $invest_usuaR = Investigaciones_usuarios::create([
                'investigaciones_id_investigaciones' => $investigacion->id_investigaciones,
                'users_id' => $userR,
                'tipo_participaciones' => 'responsable'
            ]);  
            foreach($data['colaboradores'] as $users){
                $user = User::where('email',$users)->first();
                $invest_usua = Investigaciones_usuarios::create([
                    'investigaciones_id_investigaciones' => $investigacion->id_investigaciones,
                    'users_id' => $user->id,
                    'tipo_participaciones' => 'colaborador'
                ]);  
            }
             
           // dd($investigacion);
           if ($role == 1){
                $invest_esta = Investigacion_estados::create([
                    'estado_investigaciones' => $data['estado'],
                    'indicador_estados' => 1,
                    'investigaciones_id_investigaciones' => $investigacion->id_investigaciones
                ]);
                foreach($data['observaciones'] as $obse){
                    $obse_esta = Estado_observaciones::create([
                        'observaciones' => $obse,
                        'investigacion_estados_id_investigacion_estados' => $invest_esta->id_investigacion_estado
                    ]);
                }; 
           }else{
                $invest_esta = Investigacion_estados::create([
                    'estado_investigaciones' => 'estudio',
                    'indicador_estados' => 1,
                    'investigaciones_id_investigaciones' => $investigacion->id_investigaciones
                ]);
           }
            
             
            foreach($data['objeEspes'] as $obje){
                $obje_espe = Objetivos_especificos::create([
                    'desc_objetivos_especificos' => $obje,
                    'investigaciones_id_investigaciones' => $investigacion->id_investigaciones
                ]);
            };
            
            DB::commit();
            
            return true;
        }
        catch(\Exeption $ex)
		{
            DB::rollback();
            return false;
		}
    }
    public static function updateInvest(array $data, $id){
        $role = Auth::user()->role_id;
        DB::beginTransaction();
        try{
            //dd($data);
            $tipo_invest;
            $publicado = 0;
            if ($data['beneficiario']){
                $tipo_invest = 'Extension';
            }else{
                $tipo_invest = 'Investigacion';
            }
            if ($role == 1){
                if ($data['publicado']=='publicado'){
                    $publicado = 1;
                }
            }
            
            $sede;
            $sede2;
            if($data['sedes'] == 'San Pedro'){
                $sede = 1;
                $sede2 = 'San Pedro';
            }
            if($data['sedes'] == 'Heredia'){
                $sede = 2;
                $sede2 = 'Heredia';
            }
            if($data['sedes'] == 'Guápiles'){
                $sede = 3;
                $sede2 = 'GuÃ¡piles';
            }
            if($data['sedes'] == 'Pérez Zeledón'){
                $sede = 4;
                $sede2 = 'Perez ZelÃ©don';
            }
            if($data['sedes'] == 'Santa Cruz'){
                $sede = 5;
                $sede2 = 'Santa Cruz';
            }
            if($data['sedes'] == 'Grecia'){
                $sede = 6;
                $sede2 = 'Grecia';
            }
            if ($role == 1){
                $investigacion = Investigacion::find($id);
                $investigacion->nombre_investigaciones = $data['nombre'];
                $investigacion->justificacion_investigaciones = $data['justificacion'];
                $investigacion->tipo_investigaciones = $tipo_invest;
                $investigacion->publicado_investigaciones = $publicado;
                $investigacion->metodologia_investigaciones = $data['metodologia'];
                $investigacion->presupuesto_investigaciones = $data['presupuesto'];
                $investigacion->objetivo_gnrl_investigaciones = $data['obj-gnrl'];
                $investigacion->sedes_id_sedes = $sede;
                $investigacion->sedes_nombre_sedes =  $sede2;
                $investigacion->beneficiario_investigaciones = $data['beneficiario'];
                $investigacion->save();
                DB::table('investigacion_estados')->where('investigaciones_id_investigaciones',$id)->where('indicador_estados',1)->update(['indicador_estados'=>0]);
            
                $invest_esta = Investigacion_estados::create([
                    'estado_investigaciones' => $data['estado'],
                    'indicador_estados' => 1,
                    'investigaciones_id_investigaciones' => $investigacion->id_investigaciones
                ]);
                if(!empty($data['observaciones'])){
                    foreach($data['observaciones'] as $obse){
                        $obse_esta = Estado_observaciones::create([
                            'observaciones' => $obse,
                            'investigacion_estados_id_investigacion_estados' => $invest_esta->id_investigacion_estado
                        ]);
                    };
                }
                 
                foreach($data['colaboradores'] as $users){
                    $user = User::where('email',$users)->first();
                    $usua_inv= Investigaciones_usuarios::where('users_id',$user->id)->where('investigaciones_id_investigaciones',$investigacion->id_investigaciones)->first();
                    //dd($usua_inv);
                    if($usua_inv == null){
                        $invest_usua = Investigaciones_usuarios::create([
                            'investigaciones_id_investigaciones' => $investigacion->id_investigaciones,
                            'users_id' => $user->id,
                            'tipo_participaciones' => 'colaborador'
                        ]); 
                    }
                     
                }
                //dd($data);
                if(!empty($data['objeEspes'])){
                    foreach($data['objeEspes'] as $obje){
                        $obje_espe = Objetivos_especificos::create([
                            'desc_objetivos_especificos' => $obje,
                            'investigaciones_id_investigaciones' => $investigacion->id_investigaciones
                        ]);
                    };
                }
            }else{
                $investigacion = Investigacion::find($id);
                $investigacion->nombre_investigaciones = $data['nombre'];
                $investigacion->justificacion_investigaciones = $data['justificacion'];
                $investigacion->tipo_investigaciones = $tipo_invest;
                $investigacion->publicado_investigaciones = $publicado;
                $investigacion->objetivo_gnrl_investigaciones = $data['obj-gnrl'];
                $investigacion->sedes_id_sedes = $sede;
                $investigacion->sedes_nombre_sedes = $sede2;
                $investigacion->beneficiario_investigaciones = $data['beneficiario'];
                $investigacion->save();
                foreach($data['colaboradores'] as $users){
                    $user = User::where('email',$users)->first();
                    $usua_inv= Investigaciones_usuarios::where('users_id',$user->id)->where('investigaciones_id_investigaciones',$investigacion->id_investigaciones)->first();
                    //dd($usua_inv);
                    if($usua_inv == null){
                        $invest_usua = Investigaciones_usuarios::create([
                            'investigaciones_id_investigaciones' => $investigacion->id_investigaciones,
                            'users_id' => $user->id,
                            'tipo_participaciones' => 'colaborador'
                        ]); 
                    }
                     
                }
                //dd($data);
                if(!empty($data['objeEspes'])){
                    foreach($data['objeEspes'] as $obje){
                        $obje_espe = Objetivos_especificos::create([
                            'desc_objetivos_especificos' => $obje,
                            'investigaciones_id_investigaciones' => $investigacion->id_investigaciones
                        ]);
                    };
                }
                
            }
            
            DB::commit();
                
            return true;
        }
        catch(\Exeption $ex)
		{
            DB::rollback();
            return false;
		}
        
    }
    public static function participa($id){
        DB::beginTransaction();
        try{
            $userR = Auth::user()->id;
            $investigacion = Investigacion::find($id);
            $invest_usuaR = Investigaciones_usuarios::create([
                'investigaciones_id_investigaciones' => $investigacion->id_investigaciones,
                'users_id' => $userR,
                'tipo_participaciones' => 'colaborador'
            ]);
            DB::commit();
                
            return true;
        }
        catch(\Exeption $ex)
        {
            DB::rollback();
            return false;
        }
    }
    public static function createPlan(array $data, $id){
        //dd($id);
        DB::beginTransaction();
        try{
            $periodo = 0;
            if($data['periodo']== '3 meses'){
                $periodo = 3;
            }
            if($data['periodo'] == '6 meses'){
                $periodo = 6;
            }
            if($data['periodo'] == '12 meses'){
                $periodo = 12;
            }
            $plan = Planes:: where('investigaciones_id_investigaciones',$id)->first();
            if(!$plan){
                $plan = Planes::create([
                    'nombre_planes' => $data['nombre'],
                    'periodo_planes' => $periodo,
                    'investigaciones_id_investigaciones' =>$id 
                ]);
            }
            
            list( $ano, $mes, $dia ) = explode("-",$data['fecha']); 
            $ano_fin = $ano;
            $mes_fin = $mes + $periodo;
            if($mes_fin > 12){
                $mes_fin = $mes_fin - 12;
                $ano_fin ++;
            }
            $dia_fin = $dia;
            $fecha_fin = ($ano_fin.'-'.$mes_fin.'-'.$dia_fin);
            //dd($data);
            $objetivo = Objetivos_planes::create([
                'desc_objetivo_planes' => $data['objeEspe'],
                'resultados_esperados' => $data['resultado'],
                'recursos_objetivos' => $data['recursos'],
                'indicadores_resultados' => $data['indi'],
                'fecha_inicios' => $data['fecha'],
                'fecha_finales' => $fecha_fin,
                'planes_id_planes' => $plan->id_planes 
            ]);
            //dd($objetivo);
            foreach($data['encargados'] as $users){
                $user = User::where('email',$users)->first();
                $objUser = Objetivos_planes_users:: create([
                    'obejtivos_planes_id_obejtivos_planes' => $objetivo->id_obejtivos_planes,
                    'users_id' => $user->id
                ]);  
            }

            DB::commit();
                
            return true;
        }
        catch(\Exeption $ex)
		{
            DB::rollback();
            return false;
		}
    }
    public static function updateObje(array $data, $id, $idObj){
      
        DB::beginTransaction();
        try{
            //dd($data);
            $periodo = 0;
            if($data['periodo']== '3 meses'){
                $periodo = 3;
            }
            if($data['periodo'] == '6 meses'){
                $periodo = 6;
            }
            if($data['periodo'] == '12 meses'){
                $periodo = 12;
            }
            list( $ano, $mes, $dia ) = explode("-",$data['fecha']); 
            $ano_fin = $ano;
            $mes_fin = $mes + $periodo;
            if($mes_fin > 12){
                $mes_fin = $mes_fin - 12;
                $ano_fin ++;
            }
            $dia_fin = $dia;
            $fecha_fin = ($ano_fin.'-'.$mes_fin.'-'.$dia_fin);
            $plan = Planes:: where('id_planes',$id)->first();
            $plan->nombre_planes = $data['nombre'];
            $plan->periodo_planes = $periodo;
            $plan->save();
            
            $objetivo = Objetivos_planes::find($idObj);
            //dd($objetivo); 
            $objetivo->desc_objetivo_planes = $data['objeEspe'];
            $objetivo->resultados_esperados = $data['resultado'];
            $objetivo->recursos_objetivos   = $data['recursos'];
            $objetivo->indicadores_resultados = $data['indi'];
            $objetivo->fecha_inicios = $data['fecha'];
            $objetivo->fecha_finales = $fecha_fin;
            $objetivo->save();
            
           foreach($data['encargados'] as $users){
                $user = User::where('email',$users)->first();
                $objUser = Objetivos_planes_users::where('users_id',$user->id)->where('obejtivos_planes_id_obejtivos_planes',$objetivo->id_obejtivos_planes)->first();
                if(!$objUser){
                    $obj = Objetivos_planes_users:: create([
                        'obejtivos_planes_id_obejtivos_planes' => $objetivo->id_obejtivos_planes,
                        'users_id' => $user->id
                    ]); 
                }
                 
            }
            DB::commit();
                
            return true;
        }
        catch(\Exeption $ex)
		{
            DB::rollback();
            return false;
		}
        
    }
    public static function deleteInvest($id){
        DB::beginTransaction();
        try{
            //relacion entre investigaciones y usuarios
            $users_invest = DB::select('select * from investigaciones_usuarios where investigaciones_id_investigaciones = '.$id);
            if ($users_invest){
                foreach($users_invest as $ui){
                    $uE = Investigaciones_usuarios::where('investigaciones_id_investigaciones',$ui->investigaciones_id_investigaciones);
                    $uE->delete();
                }
            }
            //relacion entre investigaciones y estados
            $estado = DB::select('select * from investigacion_estados where investigaciones_id_investigaciones = '.$id); 
            
            if ($estado){
                foreach($estado as $es){
                    $observaciones = DB::select('select * from estado_observaciones where investigacion_estados_id_investigacion_estados = '.$es->id_investigacion_estados);
                    
                    if ($observaciones){
                        foreach($observaciones as $ob){
                            $obsE = Estado_observaciones::where('id_estado_observaciones',$ob->id_estado_observaciones);
                            $obsE->delete();
                        }
                    }
                    $estadoE = Investigacion_estados::where('id_investigacion_estados',$es->id_investigacion_estados);
                    $estadoE->delete();
                    
                }
            }
            $planes = Planes::where('investigaciones_id_investigaciones',$id)->first();
            if($planes){
                $objePlan = DB::select('select * from obejtivos_planes where planes_id_planes = '.$planes->id_planes);
                if ($objePlan){
                    //dd($objePlan);
                    foreach($objePlan as $op){
                        $users_plan = DB::select('select * from obejtivos_planes_users where obejtivos_planes_id_obejtivos_planes = '.$op->id_obejtivos_planes);
                      //  dd($users_plan);
                        if ($users_plan){
                            foreach($users_plan as $up){
                                $userDel = Objetivos_planes_users::where('obejtivos_planes_id_obejtivos_planes',$up->obejtivos_planes_id_obejtivos_planes);
                                $userDel->delete();
                            }
                        }
                        $objeDe = Objetivos_planes::where('planes_id_planes',$op->planes_id_planes)->first();
                        $objeDe->delete();
                    }
                }
                $planes->delete();
            }
            $objeEspes = DB::select('select * from objetivos_especificos where investigaciones_id_investigaciones ='.$id );
            if ($objeEspes){
                foreach($objeEspes as $oe){
                    $oeE = Objetivos_especificos::where('investigaciones_id_investigaciones', $oe->investigaciones_id_investigaciones);
                    $oeE->delete();
                }
            }
            $investigaciones = Investigacion::find($id); 
            $investigaciones->delete();
            DB::commit();
            return true;
        }
        catch(\Exeption $ex)
		{
            DB::rollback();
            return false;
		}
    }
    public static function deleteObj($id){
        DB::beginTransaction();
        try{
            $users_plan = DB::select('select * from obejtivos_planes_users where obejtivos_planes_id_obejtivos_planes = '.$id);
            
            if ($users_plan){
                foreach($users_plan as $up){
                    $userDel = Objetivos_planes_users::where('obejtivos_planes_id_obejtivos_planes',$up->obejtivos_planes_id_obejtivos_planes);
                    $userDel->delete();
                }
            }
            $objetivoDel = Objetivos_planes::find($id);
            $objetivoDel->delete();
            DB::commit();
            return true;
        }
        catch(\Exeption $ex)
		{
            DB::rollback();
            return false;
		}
    }
    
}