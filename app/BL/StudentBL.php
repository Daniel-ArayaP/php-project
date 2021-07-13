<?php

namespace App\BL;

use App\Models\PersonProfile;
use App\Models\Student;
use App\Models\User;
use App\Models\Role;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use Faker\Provider\he_IL\Person;
use App\Enums\ChangePasswordResult;
use App\Models\Period;
use App\Enums\StudentRegisterResult;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Tutor;
use App\Models\Solicitud;
use App\Mail\ActivateNewStudent;

class  StudentBL
{
	public static function createStudent(array $data)
	{
		DB::beginTransaction();

		try
		{
			$period = Period::where('active', true)->first();

			$person = PersonProfile::create([
				'first_name' => $data['name'],
				'last_name1' => $data['lastName1'],
				'last_name2' => $data['lastName2'],
				'phone' => $data['phone']
			]);

			$user = User::create([
				'email' => $data['email'],
				'password' => SecurityHelper::EncryptPassword($data['password']),
				'role_id' => 2,
				'is_active' => 1,
				'is_locked_out' => 1
			]);

			if(isset($data['curriculum']))
			{
				$curriculum= $data['curriculum'];
				$curriculum_route= $person->id.'_'.$curriculum->getClientOriginalName();
//				Storage::disk('local')->put($curriculum_route,file_get_contents($curriculum->getRealPath()));
				Storage::disk('public')->put($curriculum_route,file_get_contents($curriculum->getRealPath()));
			} 
			else
			{
				$curriculum_route=null;	
			}

			$student = Student::create([
				'person_profile_id' => $person->id,
				'user_id' => $user->id,
				'id_document' => $data['pID'],
				'university_identification' => $data['uID'],
				'university_email' => $data['email'],
				'personal_email' => $data['pEmail'],
				'gender_id' => (int)$data['gender'],
				'pes_registered' => false,
				'tfg_registered' => false,
				'tcu_registered' => false,
				'period_id' => $period->id??0,
				'curriculum'=> $curriculum_route,
				'tutor_profile_id' => 0
			]);

			DB::commit();

			//Mail::to($data['email'])->send(new ActivateNewStudent($user->id));
			
			return StudentRegisterResult::SUCCESS;
		}
		catch(\Exeption $ex)
		{
			DB::rollback();

			return StudentRegisterResult::INTERNAL_ERROR;
		}
	}

	public static function editStudent(array $data, $userId)
	{
		DB::beginTransaction();

		try
		{
			$student = Student::where('user_id', $userId)->first();
			$student->id_document = $data['pID'];
			$student->university_identification = $data['uID'];
			$student->personal_email = $data['pEmail'];
			$student->gender_id = $data['gender'];
			if(isset($data['curriculum']))
			{
				$curriculumAnterior=DB::table('students')->where('user_id',$userId)->value('curriculum');
				Storage::disk('public')->delete($curriculumAnterior);
				$curriculum= $data['curriculum'];
				$curriculum_route= $userId.'_'.$curriculum->getClientOriginalName();
				Storage::disk('public')->put($curriculum_route,file_get_contents($curriculum->getRealPath()));
				$student->curriculum=$curriculum_route;
			}
			
			if (isset($data['tutor']))
				$student->tutor_profile_id = $data['tutor'];
				
			$student->save();

			$person = PersonProfile::find($student->person_profile_id);
			$person->first_name = $data['name'];
			$person->last_name1 = $data['lastName1'];
			$person->last_name2 = $data['lastName2'];
			$person->phone = $data['phone'];
			$person->save();

			if(isset($data['curriculum']))
			{
				$person=DB::table('students')->where('user_id',$userId)->value('person_profile_id');
				$curriculum=DB::table('students')->where('user_id',$userId)->value('curriculum');
				$solicitud=DB::table('solicitudes')->where('person_profile_id',$person)->get();
				
				foreach($solicitud as $sol)
				{
					DB::table('solicitudes')->where('person_profile_id',$person)->update( ['curriculum'=>$curriculum]);
					
				}	
			}
			$solicitud=DB::table('solicitudes')->where('person_profile_id',$person)->get();
				
				foreach($solicitud as $sol)
				{
					DB::table('solicitudes')->where('person_profile_id',$person)->update(['student_personal_email'=> $data['pEmail']]);
					
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

	public static function changePassword(array $data, $userId) 
	{
		try
		{
			$user = User::find($userId);
			$encodedOldPass = base64_encode($data['oldPassword']);

			if (!password_verify($encodedOldPass, $user->password)) {
				return ChangePasswordResult::OLDPASSWORD_ERROR;
			}

			$user->password = SecurityHelper::EncryptPassword($data['password']);
			$user->save();

			return ChangePasswordResult::SUCCESS;
		}
		catch(\Exeption $ex)
		{
			return ChangePasswordResult::INTERNAL_ERROR;
		}
	}


	public static function searchStudents(array $data)
	{
		$searchResult = Student::whereHas('profile', function ($query) use ($data) {
			$query->where('first_name', 'like', '%' . $data['name'] . '%')
					->orWhere('last_name1', 'like', '%' . $data['name'] . '%')
					->orWhere('last_name2', 'like', '%' . $data['name'] . '%');
		});

		if ($data['process'] == 3) {
			$searchResult->where('tcu_registered', '=', true)
							->where('pes_registered', '=', false)
							->where('tfg_registered', '=', false);
		} if ($data['process'] == 4) {
			$searchResult->where('pes_registered', '=', true)
							->where('tcu_registered', '=', false)
							->where('tfg_registered', '=', false);
		}
		else if ($data['process'] == 5) {
		$searchResult->where('tfg_registered', '=', true)
							->where('tcu_registered', '=', false)
							->where('pes_registered', '=', false);
		}

		if ($data['period'] != 'all') {
			$searchResult->where('period_id', '=', $data['period']);
	}
		

		return $searchResult;
		
	}

	public static function searchByPeriod(array $data) 
	{
		$period = Period::where('active', true)->first();

		$searchResult = Student::whereHas('profile', function ($query) use ($data) {
			$query->where('first_name', 'like', '%' . $data['name'] . '%')
					->orWhere('last_name1', 'like', '%' . $data['name'] . '%')
					->orWhere('last_name2', 'like', '%' . $data['name'] . '%');
		});

		$searchResult->where('period_id', '=', $period->id);

		return $searchResult;
	}

	public static function register(array $data)
	{
		try
		{
			if ($data['process'] == null) {
				return StudentRegisterResult::NO_DATA;
			}

			$student = Student::find($data['id']);

			switch ($data['process']) {
				case 3:
					if ($student->tcu_registered) {
						return StudentRegisterResult::ALREADY_REGISTERED;
					}

					$student->tcu_registered = true;
					$student->pes_registered = false;
					$student->tfg_registered = false;
					$student->save();
					break;
				case 4:
					if ($student->pes_registered) {
						return StudentRegisterResult::ALREADY_REGISTERED;
					}

					$student->pes_registered = true;
					$student->tcu_registered = false;
					$student->tfg_registered = false;
					$student->save();
					break;
				case 5:
					if ($student->tfg_registered) {
						return StudentRegisterResult::ALREADY_REGISTERED;
					}

					$student->tfg_registered = true;
					$student->tcu_registered = false;
					$student->pes_registered = false;
					$student->save();
					break;
			}

			return StudentRegisterResult::SUCCESS;
		}
		catch(\Exeption $ex)
		{
			return StudentRegisterResult::INTERNAL_ERROR;
		}
	}

	public static function activate(array $data)
	{
		try
		{
			$student = Student::find($data['id']);
			$temp = $student->user_id;
			$user = User::find($temp);
			$user->is_locked_out = 0;
			$user->save();



			return StudentRegisterResult::SUCCESS;
		}
		catch(\Exeption $ex)
		{
			return StudentRegisterResult::INTERNAL_ERROR;
		}
	}

	public static function updatePeriod($id)
	{
		try
		{
			$period = Period::where('active', true)->first();
			$student = Student::find($id);

			if ($student->period_id == $period->id) {
				return false;
			}

			$student->period_id = $period->id;
			$student->save();
			return true;
		}
		catch(\Exeption $ex)
		{
			return false;
		}
	}


    public static function addCurriculumStudent(array $data, $userId)
    {
        DB::beginTransaction();

        try
        {
            $student = Student::where('user_id', $userId)->first();

            if(isset($data['curriculum']))
            {
                $curriculum= $data['curriculum'];
                $curriculum_route= $userId.'_'.$curriculum->getClientOriginalName();
//                Storage::Disk('local')->put($curriculum_route,file_get_contents($curriculum->getRealPath()));
                Storage::Disk('public')->put($curriculum_route,file_get_contents($curriculum->getRealPath()));
                $student->curriculum=$curriculum_route;
            }


            $student->save();


            DB::commit();
            return true;
        }
        catch(\Exeption $ex)
        {
            DB::rollback();
            return false;
        }
    }


    public static function addTutorStudent(array $data, $userId)
    {
        DB::beginTransaction();

        try
        {
            $student = Student::where('user_id', $userId)->first();


            if (isset($data['tutor']))
                $student->tutor_profile_id = $data['tutor'];

            $student->save();


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