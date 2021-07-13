<?php

namespace App\BL;

use App\Models\PersonProfile;
use App\Models\Admin;
use App\Models\User;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use App\Enums\ChangePasswordResult;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAdminUserCreated;
use App\Enums\SaveResult;
use Illuminate\Support\Facades\Auth;
use App\Enums\StudentRegisterResult;

class RegistroBL
{

    public static function editAdmin(array $data, $userId)
    {
        DB::beginTransaction();

        try
        {
            $admin = Admin::where('user_id', $userId)->first();
            $admin->email = $data['email'];
            $admin->save();

            $person = PersonProfile::find($admin->person_profile_id);
            $person->first_name = $data['name'];
            $person->last_name1 = $data['lastName1'];
            $person->last_name2 = $data['lastName2'];
            $person->phone = $data['phone'];
            $person->save();

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

    public static function searchUsers(array $data)
    {
        $searchResult = Admin::whereHas('profile', function ($query) use ($data) {
            $query->where('first_name', 'like', '%' . $data['name'] . '%')
                ->orWhere('last_name1', 'like', '%' . $data['name'] . '%')
                ->orWhere('last_name2', 'like', '%' . $data['name'] . '%');
        });

        $searchResult->where('user_id', '<>', Auth::user()->id);

        return $searchResult;
    }

    public static function createUser($data)
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

            $tempPassword = SecurityHelper::generatePassword();

            $user = User::create([
                'email' => $data['email'],
                'password' => SecurityHelper::EncryptPassword($tempPassword),
                'role_id' => 5
            ]);

            $admin = Admin::create([
                'person_profile_id' => $person->id,
                'user_id' => $user->id,
                'email' => $data['email']
            ]);

            DB::commit();

            Mail::to($admin->email)->send(new NewAdminUserCreated($user->email, $tempPassword));

            return SaveResult::SUCCESS;
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return SaveResult::INTERNAL_ERROR;
        }
    }

    public static function deleteAdmin($id)
    {
        DB::beginTransaction();

        try
        {
            $admin = Admin::find($id);
            $profile = $admin->profile();
            $user = $admin->user();

            $admin->delete();
            $profile->delete();
            $user->delete();

            DB::commit();

            return true;
        }
        catch (\Exception $ex)
        {
            DB::rollback();
            return false;
        }
    }

    public static function createAdmin(array $data)
    {
        DB::beginTransaction();

        try
        {
            $person = PersonProfile::create([
                'first_name' => $data['name'],
                'last_name1' => $data['lastName1'],
                'last_name2' => $data['lastName2'],
                'phone' => $data['phone']
            ]);
            //$tempPassword = SecurityHelper::generatePassword();
            //tempPassword

            $user = User::create([
                'email' => $data['email'],
                'password' => SecurityHelper::EncryptPassword('123456'),
                'role_id' => 1,
                'is_active' => 1,
                'is_locked_out' => 1
            ]);

            $admin = Admin::create([
                'person_profile_id' => $person->id,
                'user_id' => $user->id,
                'email' => $data['email']
            ]);

            DB::commit();
           // Mail::to($admin->email)->send(new NewAdminUserCreated($user->email, $tempPassword));

            return StudentRegisterResult::SUCCESS;

        }
        catch(\Exeption $ex)
        {
            DB::rollback();

            return StudentRegisterResult::INTERNAL_ERROR;
        }
    }

    public static function activate(array $data)
    {
        try
        {
            //dd($data);
            $admin = Admin::find($data['id']);
            $temp = $admin->user_id;
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
}

