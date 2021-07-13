<?php

namespace App\BL;

use App\Models\Tutor;
use App\Enums\SaveResult;
use App\Models\PersonProfile;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TutorAssignment;
use App\Models\Period;
use App\Mail\AssignedStudents;

class TutorBL
{
	public static function createTutor(array $data)
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

			$tutor = Tutor::create([
				'person_profile_id' => $person->id,
				'identification_document' => $data['identification_document'],
//                'password' => SecurityHelper::EncryptPassword($data['password']),
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

	public static function editTutor(array $data)
    {
        try
        {
			$tutor = Tutor::find($data['id']);

			$tutor->profile['first_name'] = $data['firstName'];
			$tutor->profile['last_name1'] = $data['lastName1'];
			$tutor->profile['last_name2'] = $data['lastName2'];
			$tutor->profile['phone'] = $data['phone'];
			$tutor->identification_document = $data['identification_document'];
			$tutor->email = $data['email'];

			$tutor->profile->save();
            $tutor->save();

            return SaveResult::SUCCESS;
        }
        catch(\Exception $ex) {
            return SaveResult::INTERNAL_ERROR;
        }
    }

    public static function searchTutor(array $data)
	{
		$searchResult = Tutor::whereHas('profile', function ($query) use ($data) {
			$query->where('first_name', 'like', '%' . $data['name'] . '%')
					->orWhere('last_name1', 'like', '%' . $data['name'] . '%')
					->orWhere('last_name2', 'like', '%' . $data['name'] . '%');
        });
        //dd($searchResult);
        return $searchResult;
	}

	public static function deleteTutor($tutor)
	{
		DB::beginTransaction();

		try
		{
			$tutor = Tutor::find($tutor);
			$profile = PersonProfile::find($tutor->person_profile_id);

            $tutor->students()->detach();
			$tutor->delete();
			$profile->delete();

			DB::commit();

			return true;
		}
		catch (\Exception $ex)
		{
			DB::rollback();
			return false;
		}
	}
}
