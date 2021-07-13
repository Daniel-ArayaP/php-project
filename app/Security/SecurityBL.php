<?php

namespace App\Security;

use DB;
use App\Models\User;
use App\Enums\LoginResult;
use \Datetime;
use Illuminate\Support\Facades\Auth;

class SecurityBL
{
  private const LOGIN_ERROR = 'Usuario o password invalido';

  public static function login(array $data) {   //array $data

    $user = User::where('email', $data['email'])->first();
   //$user =  DB::table("users")->where(DB::raw("email"), $data['email'])->first();

    if ($user === NULL) {
      return LoginResult::INVALID_USER;
    }

    if (!$user->is_active) {
      return LoginResult::INVALID_USER;
    }

    if ($user->is_locked_out && date_diff(new DateTime($user->lock_start_date_time), new DateTime(date('Y-m-d H:i:s')))->i < 10) {
      return LoginResult::LOCKED_OUT;
    }

    $encodedPass = base64_encode($data['password']);

    if (!password_verify($encodedPass, $user->password)) {
      
      if ($user->fail_attempt_count <= 5) {
        User::where('id', $user->id)
        ->update([
          'is_locked_out' => false,
          'lock_start_date_time' => null,
          'fail_attempt_count' => ($user->fail_attempt_count + 1)
          ]);

        return LoginResult::INVALID_PASSWORD;
      }

      User::where('id', $user->id)
        ->update([
          'fail_attempt_count' => 0,
          'is_locked_out' => true,
          'lock_start_date_time' => date('Y-m-d H:i:s')
          ]);
  
      return LoginResult::LOCKED_OUT;
    }

    User::where('id', $user->id)
        ->update([
          'fail_attempt_count' => 0,
          'last_login_date' => date('Y-m-d H:i:s')
          ]);

    Auth::guard()->login($user);
    return LoginResult::SUCCESS;
  }
}
