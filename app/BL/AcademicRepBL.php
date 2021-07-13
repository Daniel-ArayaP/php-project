<?php

namespace App\BL;

use Illuminate\Support\Facades\DB;
use App\Enums\SaveResult;
use App\Models\AcademicRepresentative;
use App\Models\PersonProfile;

class AcademicRepBL 
{
    public static function searchAcademicRep(array $data)
	{
		$searchResult = AcademicRepresentative::whereHas('profile', function ($query) use ($data) {
			$query->where('first_name', 'like', '%' . $data['name'] . '%')
					->orWhere('last_name1', 'like', '%' . $data['name'] . '%')
					->orWhere('last_name2', 'like', '%' . $data['name'] . '%');
		});
		
		$searchResult->where('deleted', '=', false);
        
        return $searchResult;
	}

	public static function createAcademicRep($data)
	{
		DB::beginTransaction();

		try
		{
			$person = PersonProfile::create([
				'first_name' => $data['firstName'],
				'last_name1' => $data['lastName1'],
				'last_name2' => $data['lastName2'],
				'phone' => $data['phone']
			]);

			$rep = AcademicRepresentative::create([
				'person_profile_id' => $person->id,
				'identification_document' => $data['identification_document'],
				'email' => $data['email']
			]);
			

			DB::commit();

			return SaveResult::SUCCESS;
		}
		catch(\Exception $ex)
		{
			DB::rollback();
			return SaveResult::INTERNAL_ERROR;
		}
	}

	public static function editAcademicRep(array $data) 
    {
        try 
        {
			$rep = AcademicRepresentative::find($data['id']);

			$rep->profile['first_name'] = $data['firstName'];
			$rep->profile['last_name1'] = $data['lastName1'];
			$rep->profile['last_name2'] = $data['lastName2'];
			$rep->profile['phone'] = $data['phone'];
			$rep->identification_document = $data['identification_document'];
			$rep->email = $data['email'];

			$rep->profile->save();
            $rep->save();

            return SaveResult::SUCCESS;
        }
        catch(\Exception $ex) {
            return SaveResult::INTERNAL_ERROR;
        }
	}
	
	public static function deleteRep($repId)
	{
		try
		{
			$rep = AcademicRepresentative::destroy($repId);
//			$rep->deleted = true;
//			$rep->save();

			return true;
		}
		catch (\Exception $ex)
		{
			return false;
		}
	}
}