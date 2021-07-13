<?php

namespace App\BL;

use App\Models\PersonProfile;
use App\Models\Student;
use App\Models\User;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use Faker\Provider\he_IL\Person;
use App\Enums\ChangePasswordResult;
use App\Models\Period;
use App\Enums\StudentRegisterResult;
use App\Enums\SaveResult;
 

class InstituteBL
{
	public static function createInstitute(array $data)
	{

    
    
    // Insert new Institute

		DB::beginTransaction();

		try
		{
		
			$idSedes =$data['headquarter']; 

			$rol = \DB::table("roles")->where(DB::raw("id"),4)->first();
            $sede = \DB::table("sedes")->where(DB::raw("id_sedes"),$idSedes)->first();

			$person = PersonProfile::create([
				'first_name' => $data['nameInstitute'],
				'last_name1' => 'null',
				'last_name2' => 'null',
				'phone' => $data['phoneInstitute']
			]);

			$user = User::create([
				'email' => $data['emailInstitute'],
				'password' => SecurityHelper::EncryptPassword($data['passwordInstitute_confirmation']),
				'role_id' => $rol->id,
				'is_locked_out' => 1
			]);

            


            $instituto = DB::table('institutos')->insertGetId(
                ['usuario_institutos' => $data['emailInstitute'], 
                 'id_sedes' => $data['headquarter'],
                 'nombre_sedes' => $sede->nombre_sedes,
                 'contrasena_institutos' => SecurityHelper::EncryptPassword($data['passwordInstitute_confirmation']),
                 'nombre_institutos' =>$data['nameInstitute'],
                 'correo_institutos' =>$data['emailInstitute'],
                 'direccion_institutos' => $data['directionInstitute'],
                 'encargado_institutos' => $data['nameIncharge'],
                 'telefono_institutos' => $data['phoneInstitute'],
                 'celular_encargado_institutos' => $data['cellPhoneIncharge']
                ]);
            
          

			DB::commit();

			return $user;
		}
		catch(\Exeption $ex)
		{
			DB::rollback();
		}
	}

	public static function editInstitute(array $data, $userEmail)
	{
		DB::beginTransaction();

		try
		{
			
			$idSede =$data['headquarter'];

			$sede = \DB::table("sedes")->where(DB::raw("id_sedes"),$idSede)->first();

			$institute = \DB::table("institutos")->where('usuario_institutos',  $userEmail)->update(
				['nombre_institutos' => $data['nameInstitute'],
				 'telefono_institutos' => $data['phoneInstitute'],
				 'encargado_institutos' => $data['nameIncharge'],
				 'celular_encargado_institutos' => $data['cellPhoneIncharge'],
				 'id_sedes' => $data['headquarter'],
				 'nombre_sedes' => $sede->nombre_sedes,
				 'direccion_institutos' => $data['directionInstitute']
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

	public static function changeInstitutePassword(array $data, $userId) 
	{
		try
		{
			$user = User::find($userId);
			$encodedOldPass = base64_encode($data['oldPassword']);
			$encodeNewPass = base64_encode($data['password']);

			

			if (!password_verify($encodedOldPass, $user->password)) {
				return ChangePasswordResult::OLDPASSWORD_ERROR;
			}

			$user->password = SecurityHelper::EncryptPassword($data['password']);
			$institute = DB::table("institutos")->where(DB::raw("usuario_institutos"),$user->email)->update(
				['contrasena_institutos' => $encodeNewPass

				]);
			
			$user->save();

			return ChangePasswordResult::SUCCESS;
		}
		catch(\Exeption $ex)
		{
			return ChangePasswordResult::INTERNAL_ERROR;
		}
	}

}
