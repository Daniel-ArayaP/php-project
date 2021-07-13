<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\PersonProfile;
use App\Models\Gender;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use App\BL\InstituteBL;
use App\Http\Requests\ChangePasswordRequest;
use App\Enums\ChangePasswordResult;
use App\Http\Requests\EditInstitutePerfilRequest;

class InstituteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('institute.home');
    }

    /**
     * Show the logged user profile data
     */
    public function profile()
    {

        $institutos = \DB::table("institutos")->where('usuario_institutos', Auth::user()->email)->first();

        $sedes=Sede::all(); 

        return view('institute.profile', [
            'institutos' => $institutos,
            'sedes' => $sedes
        ]);
        
    }

    public function registerInstitute(RegisterInstituteRequest $request)
    {
        
        $usernames = \DB::table("users")->where([
            ['email', '=' ,$request['emailInstitute']]
        ])->first();

        if (is_null($usernames)) {
            event(new Registered($user = $this->createInstitute($request->all())));
            return redirect()->route('login');
        } elseif ($usernames->email === $request['emailInstitute']) {
            return redirect()->route('registerInstitute')->with('error', 'El usuario ya se encuentra registrado.');
        } 

        
    }

    public function editInstituteProfile(EditInstitutePerfilRequest $request)
    {
        if (InstituteBL::editInstitute($request->all(),Auth::user()->email)) {
            return redirect('institute/profile')->with('sucess', 'Datos guardados correctamente.');
        }

        return redirect('institute/profile')->with('error', 'Los datos no pudieron ser guardados.');
    }

    public function changeInstitutePassword(ChangePasswordRequest $request)
    {
        $result = InstituteBL::changeInstitutePassword($request->all(), Auth::user()->id);

        switch ($result) {
            case ChangePasswordResult::SUCCESS:
                return redirect('institute/profile')->with('sucess', 'Contrase&ntilde;a cambiada correctamente.');
                break;
            case ChangePasswordResult::OLDPASSWORD_ERROR:
                return redirect('institute/profile')->with('error', 'El password anterior no es correcto.');
                break;
            case ChangePasswordResult::INTERNAL_ERROR:
                return redirect('institute/profile')->with('error', 'Error interno consulte al administrador.');
                break;
        }
    }
}
