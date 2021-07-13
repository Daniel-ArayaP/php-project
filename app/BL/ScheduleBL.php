<?php

namespace App\BL;

use App\Models\Schedule;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Period;
use App\Models\Modality;
use App\Enums\SaveResult;

class ScheduleBL
{


    public static function searchSchedule(array $data)
    {
     
        $searchResult = Schedule::where('period', 'like', '%' . $data['period'] . '%');

        if (isset($data['period'])) {
            $searchResult->where('periods_id', '=', $data['period']);
        }
        return $searchResult;
    }

    public static function createSchedule(array $data)
    {
        try
        {

            $period = Period::where('active', true)->first();
            $start = strtotime($data['startDate']);
            $startTime = strtotime($data['startTime']);
            $end = strtotime($data['endDate']);
            $endTime = strtotime($data['endTime']);
            $schedule = strtotime($data['schedule']);
            $startDateTime =  date("Y-m-d H:i:s", strtotime(date('Y-m-d',$start) . date("H:i", $startTime)));
            $finishDateTime =  date("Y-m-d H:i:s", strtotime(date('Y-m-d',$end) . date("H:i", $endTime)));


            Schedule::create([
                'start_day' => $startDateTime,
                'finish_day' => $finishDateTime,
                'modalities_id' => $data['modality'],
                'schedule_date' => date('Y-m-d',$schedule),
                'sedes_id_sedes' => isset($data['sedes_id_sedes']) ? $data['sedes_id_sedes'] : 2,

            ]);

            return true;
        }
        catch(\Exception $ex)
		{
            return false;
		}
    }

    public static function editSchedule(array $data)
    {
        try
        {
            $period = Period::where('active', true)->first();
            $start = strtotime($data['startDate']);
            $startTime = strtotime($data['startTime']);
            $end = strtotime($data['endDate']);
            $endTime = strtotime($data['endTime']);
            $schedule = strtotime($data['schedule']);
            $startDateTime =  date("Y-m-d H:i:s", strtotime(date('Y-m-d',$start) . date("H:i", $startTime)));
            $finishDateTime =  date("Y-m-d H:i:s", strtotime(date('Y-m-d',$end) . date("H:i", $endTime)));

            $schedules = Schedule::find($data['id']);
            $schedules->schedule_date = date('Y-m-d',$schedule);
            $schedules->start_day = $startDateTime;
            $schedules->finish_day = $finishDateTime;
            $schedules->modalities_id = $data['modality'];
            $schedules->save();

            return true;
        }
        catch(\Exeption $ex)
		{
            return false;
		}
    }
}
