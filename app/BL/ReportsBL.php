<?php

namespace App\BL;

use App\Models\PersonProfile;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\Period;
use App\Models\ProcessType;
use App\Models\Project;
use App\Models\Solicitud;
use App\Models\Participante;

class ReportsBL 
{
    public static function studentsReport(array $data)
    {
        try
        {
            $activePeriod = Period::where('active', true)->first();


            if (isset($data['period'])) {
                $searchResult = Project::where('period_id', '=', intval($data['period']));
            }
            else {
                $searchResult = Project::where('period_id', '=', $activePeriod->id);
            }

            $searchResult->where('status_id', '<>', 4);

            if (isset($data['process']) && $data['process'] != 'all') {
                $searchResult->where('process_type_id', '=', $data['process']);
            }

            return $searchResult;
        }
        catch(\Exeption $ex)
		{
            return null;
		}
    }



    public static function companiesReport(array $data)
    {
        //try
       // {
            //$activePeriod = Period::where('active', true)->first();


            //if (isset($data['period'])) {
               // $searchResult = Project::where('period_id', '=', intval($data['period']));
           // }
           // else {
              //  $searchResult = Project::where('period_id', '=', $activePeriod->id);
            //}

           // $searchResult->where('status_id', '<>', 4);

            //if (isset($data['process']) && $data['process'] != 'all') {
                //$searchResult->where('process_type_id', '=', $data['process']);
            //}

            //return $searchResult;
        //}
       // catch(\Exeption $ex)
		//{
           // return null;
		//}
    }

    public static function companiesReportStudents(array $data)
    {
        try
        {
            $activePeriod = Period::where('active', true)->first();
//            $searchResult;

            if (isset($data['period'])) {
                $searchResult = Project::where('period_id', '=', intval($data['period']));
            }
            else {
                $searchResult = Project::where('period_id', '=', $activePeriod->id);
            }

            $searchResult->where('status_id', '=', 2);

            if (isset($data['process']) && $data['process'] != 'all') {
                $searchResult->where('process_type_id', '=', $data['process']);
            }

            return $searchResult;
        }
        catch(\Exeption $ex)
		{
            return null;
		}
    }

    public static function solicitudReportStudents($id)
    {
        try
        {
        $searchSolicitud= Solicitud::where('person_profile_id',$id);
        return $searchSolicitud;
        }
        catch(\Exeption $ex)
		{
            return null;
		}
    }

    public static function participanteReportStudents($id)
    {
        try
        {
            $searchParticipante= Participante::where('person_profile_id',$id);
            return $searchParticipante;
        }
        catch(\Exeption $ex)
		{
            return null;
		}
    }

    public static function ApprovedStudentsReport(array $data)
    {
        try
        {
            $activePeriod = Period::where('active', true)->first();
            //$searchResult;
            if (isset($data['period'])) {
                $searchResult = Participante::where([['period_id', '=', intval($data['period'])], ['company_grade', '>', '69']]);
            }
            else {
                $searchResult = Participante::where([['period_id', '=', $activePeriod->id], ['company_grade', '>', '69']]);
            }
            
            return $searchResult;
        }
        catch(\Exeption $ex)
		{
            return null;
		}
    }

}
