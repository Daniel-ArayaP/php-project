<?php

namespace App\BL;

use App\Enums\CompanyRegisterResult;
use App\Mail\ActivateNewCompany;
use App\Models\PersonProfile;
use App\Models\Admin;
use App\Models\CompanyType;
use App\Models\User;
use App\Models\Company;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use App\Enums\ChangePasswordResult;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAdminUserCreated;
use App\Enums\SaveResult;
use Illuminate\Support\Facades\Auth;
use App\Enums\StudentRegisterResult;

class CompanyBL
{

    /**
     *Función para crear nuevas empresas
     *
     * @param array $data
     * @return mixed
     */
    public static function createCompany(array $data)
    {
        DB::beginTransaction();

        try
        {

            $user = User::create([
                'email' => $data['contact_email'],
                'password' => SecurityHelper::EncryptPassword($data['password']),
                'role_id' => 3,
                'is_active' => 0,
                'is_locked_out' => 1
            ]);

            $company = Company::create([
                'name' => $data['name'],
                'legal_document' => $data['legal_document'],
                'contact_name' => $data['contact_name'],
                'contact_phone' => $data['contact_phone'],
                'contact_email' => $data['contact_email'],
                'company_type_id' => $data['company_type_id']
            ]);


            DB::commit();

            Mail::to($data['contact_email'])->send(new ActivateNewCompany($user->id));

            return CompanyRegisterResult::SUCCESS;
        }
        catch(\Exeption $ex)
        {
            DB::rollback();

            return CompanyRegisterResult::INTERNAL_ERROR;
        }
    }


    /**
     * Función para editar empresas
     *
     * @param array $data
     * @param $email
     * @return bool
     */
	public static function editCompany(array $data, $email)
	{
		DB::beginTransaction();

		try
		{
            $company = Company::where('contact_email', $email)->first();
			$company->name = $data['name'];
			$company->company_type_id = $data['company_type_id'];
			$company->legal_document = $data['legal_document'];
			$company->contact_name = $data['contact_name'];
			$company->contact_phone = $data['contact_phone'];
			$company->contact_email = $data['contact_email'];
            $company->save();
            
            $company_type = CompanyType::find($company->company_type_id);

			DB::commit();
			return true;
		}
		catch(\Exeption $ex)
		{
			DB::rollback();
			return false;
		}
	}


    /**
     * Función para cambiar el password
     *
     * @param array $data
     * @param $userId
     * @return mixed
     */
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


    /**
     * Función para buscar empresas
     *
     * @param array $data
     * @return mixed
     */
	public static function searchCompanies(array $data)
	{
		//dd($data);
		$searchResult = Company::whereHas('profile', function ($query) use ($data) {
			$query->where('name', 'like', '%' . $data['name'] . '%');
		});
		return $searchResult;
	}


    /**
     * Función para activar empresas
     * @param array $data
     * @return mixed
     */
	public static function activateCompany(array $data)
	{

		try
		{
			$company = Company::where('id', $data['id'])->first();
			$temp = $company->contact_email;
			$user = User::where('email', $temp)->first();
			$user->is_locked_out = 0;
			$user->save();

			return StudentRegisterResult::SUCCESS;
		}
		catch(\Exeption $ex)
		{
			return StudentRegisterResult::INTERNAL_ERROR;
		}
	}

}
