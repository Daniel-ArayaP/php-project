<?php

namespace App\BL;

use App\Models\Period;
use App\Enums\SaveResult;

class PeriodBL
{
    public static function searchPeriod(array $data)
	{

		$searchResult = Period::where('period', 'like', '%' . $data['period'] . '%');

		return $searchResult;
    }

    public static function createPeriod(array $data, $userId, $active)
    {
        try
        {
            $start = strtotime($data['startDate']);
            $end = strtotime($data['endDate']);

            if ($start >= $end) {
                return SaveResult::DATES_ERROR;
            }

            $currentPeriod = Period::where('active', true)->first();
            $actv;

            if ($currentPeriod == null || $currentPeriod->active == false) {
                $actv = $active;
            }
            else {
                $actv = false;
            }

            Period::create([
                'period' => $data['period'],
                'start_date' => date('Y-m-d',$start),
                'end_date' => date('Y-m-d',$end),
                'active' => $actv,
                'created_by' => $userId
            ]);

            return SaveResult::SUCCESS;
        }
        catch(Exeption $ex) {
            return SaveResult::INTERNAL_ERROR;
        }
    }

    public static function editPeriod(array $data, $active)
    {
        try
        {
            $startDate = strtotime($data['startDate']);
            //dd(date('Y-m-d',$start));
            $endDate = strtotime($data['endDate']);

            if ($startDate >= $endDate) {
                return SaveResult::DATES_ERROR;
            }

            $currentPeriod = Period::where('active', true)->first();
            $actv;

            if ($currentPeriod == null || $currentPeriod->active == false) {
                $actv = $active;
            }
            else {
                $actv = false;
            }

            $period = Period::find($data['id']);
            $period->period = $data['period'];
            $period->start_date = date('Y-m-d', strtotime($data['startDate']));
            $period->end_date = date('Y-m-d',$endDate);
            $period->active = $actv;
            $period->save();

            return SaveResult::SUCCESS;
        }
        catch(Exeption $ex) {
            return SaveResult::INTERNAL_ERROR;
        }
    }
}
