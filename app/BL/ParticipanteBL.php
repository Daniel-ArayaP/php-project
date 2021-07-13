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
use App\Models\Participante;
use Storage;

class ParticipanteBL
{
    public static function create($id) 
    {

        DB::beginTransaction();
        try
		{

            $student=DB::table('solicitudes')->where('id',$id)->value('person_profile_id');
            $studentid=DB::table('students')->where('person_profile_id',$student)->value('id_document');
            $project=DB::table('solicitudes')->where('id',$id)->value('project_id');
            $period = Period::where('active', true)->first();

            $studentTutor=DB::table('students')->where('person_profile_id',$student)->value('tutor_profile_id');

            $participante= new Participante;
            $participante->person_profile_id=$student;
            $participante->student_id_document=$studentid;
            $participante->participant_project_id=$project;
            $participante->tutor_person_profile_id=$studentTutor;
            $participante->status_id = 5; // ID del valor "Aceptada" de la tabla [status]
            $participante->period_id = $period->id;
            $participante->save();
           

            DB::commit();
            
            return true;
		}
		catch(Exeption $ex)
		{
            DB::rollback();
            return false;
		}
    }
    public static function setgrade(array $data, $id)
	{
		DB::beginTransaction();

		try
		{
            $participante = Participante::where('person_profile_id', $id)->first();
			$participante->company_grade = $data['grade'];
			$participante->grade_observations = $data['grade_observations'];
            $participante->save();
            
            

			DB::commit();
			return true;
		}
		catch(\Exeption $ex)
		{
			DB::rollback();
			return false;
		}
    }
    public static function setPerformance(array $data, $id)
	{
		DB::beginTransaction();

		try
		{
            $Participante = Participante::where('person_profile_id', $id)->first();
			$Participante->status_id = $data['status'];
			$Participante->status_observations = $data['status_observations'];
            $Participante->save();

			DB::commit();
			return true;
		}
		catch(\Exeption $ex)
		{
			DB::rollback();
			return false;
		}
	}
	public static function addTutor($tutor,$student){
		try{
		$Participante = Participante::where('person_profile_id',$student )->first();
		$Participante->tutor_person_profile_id=$tutor;
		$Participante->save();
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