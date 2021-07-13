<?php

namespace App\BL;

use App\Models\PersonProfile;
use App\Models\Project;
use App\Models\Company;
use App\Models\ProjectProblem;
use App\Models\ProjectScope;
use App\Models\ProjectSpecificObjetive;
use App\Models\ProjectTool;
use App\Models\ProjectLimitation;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectStatusChanged;
use App\Models\Status;
use App\Models\Period;
use App\Models\ProjectOpportunity;
use App\Models\Solicitud;
use Storage;

class SolicitudBL
{
    public static function create(array $data, $student) 
    {

        DB::beginTransaction();
        try
		{
            $url= DB::table('students')->where('person_profile_id',$student[0]->person_profile_id)->value('curriculum');
            $curriculum=null;
            if($url!=null){
                $curriculum=$url;
            }
            $email= DB::table('students')->where('person_profile_id',$student[0]->person_profile_id)->value('personal_email');
            $company = DB::table('projects')->where('id',$data['projectId'])->value('company_id');
            $sol= DB::table('solicitudes')->orderBy('id','desc')->value('id');
           // $project = Project::find($data['projectId']);
            //$project->status_id = 11;
            //$project->student_id = $student[0]->person_profile_id;
            $solicitud= new Solicitud;
            $solicitud->id=$sol+1;
            $solicitud->person_profile_id=$student[0]->person_profile_id;
            $solicitud->curriculum=$curriculum;
            $solicitud->student_personal_email=$email;
            $solicitud->project_id=$data['projectId'];
            $solicitud->company_id = $company;
            $solicitud->status_id = 7;  // Corresponde al estado "Pendiente" de la tabla [status]
            $solicitud->save();
           // $project->save();

            DB::commit();
            
            return true;
		}
		catch(Exeption $ex)
		{
            DB::rollback();
            return false;
		}
    }
    public static function aceptSolicitud($data, $student)
    {
        DB::beginTransaction();
        try
		{
            DB::table('solicitudes')
                ->where('person_profile_id', $student)
                ->update(['status_id' => 5]);

            DB::commit();
            
            return true;
		}
		catch(Exeption $ex)
		{
            DB::rollback();
            return false;
		}
    }
    public static function rejectSolicitud($data) 
    {
        DB::beginTransaction();
        try
		{
            $solicitud = Solicitud::find($data);
            $solicitud->status_id = 6;  //id correspondiente al estado "Declinada" de la tabla [status]
            $solicitud->save();

            DB::commit();
            
            return true;
		}
		catch(Exeption $ex)
		{
            DB::rollback();
            return false;
		}
    }
}