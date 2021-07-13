<?php
/**
 * Created by PhpStorm.
 * User: Anonimos
 * Date: 1/12/2018
 * Time: 10:06
 */

namespace App\BL;
use App\Models\Convalidacion;
use Illuminate\Support\Facades\DB;

class ConvalidationBL
{
    public  static function ConvalidationStudent($id){
        $flag = true;
        $customer_data = DB::table('person_profiles as A')
            ->join('students as B', 'B.person_profile_id', '=', 'A.id')
            ->join('convalidaciones as C', 'C.students_person_profile_id', '=', 'B.person_profile_id')
            ->join('periods as D', 'D.id', '=', 'C.periodo_convalidaciones')
            ->join('universidades as E', 'E.id_universidades', '=', 'C.id_universidades_convalidaciones')
            ->join('contenido_carreras as F', 'F.ulatina_carreras_id_carreras_ulatina', '=', 'C.id_carreras_ulatina_convalidaciones')
            ->join('ulatina_carreras as G', 'G.id_carreras_ulatina', '=', 'C.id_carreras_ulatina_convalidaciones')
            ->select(DB::raw('CONCAT(A.first_name," ",A.last_name1," ",A.last_name2) AS full_name'), 'B.id_document', 'B.university_identification', 'C.id_convalidaciones' ,'C.students_person_profile_id','C.created_at' ,'D.period', 'E.nombre_universidades', 'F.id_contenido_carreras', 'F.nombre_contenido_carreras', 'F.creditos_contenido_carreras', 'G.nombre_carreras_ulatina', 'B.university_email','B.personal_email')
            ->where('C.id_convalidaciones', '=', $id)
            ->distinct()
            ->get();

        $registro_convalidaciones = DB::table('registro_convalidacion_detalles as A')
            ->join('registros as B', 'B.id_registros', '=', 'A.id_registros')
            ->join('contenido_carreras as C', 'C.id_contenido_carreras', '=', 'B.contenido_carreras_id_contenido_carreras')
            ->join('contenido_universidades as D', 'D.id_contenido_universidades', '=', 'B.contenido_universidades_id_contenido_universidades')
            ->join('universidades as E', 'E.id_universidades', '=', 'D.universidades_id_universidades')
            ->where('A.id_convalidaciones', '=', $id)
            ->distinct()
            ->get();

        return    $array = [ "customer_data" => $customer_data, "registro_convalidaciones" => $registro_convalidaciones, "flag" => $flag ];
    }

    public static function EditarConvalidacion($id,$registros){

    }

    public static function EliminarConvalidacion($id){

    }
}