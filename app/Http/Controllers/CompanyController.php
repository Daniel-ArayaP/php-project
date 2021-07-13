<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyType;
use Illuminate\Support\Facades\Auth;
use App\BL\CompanyBL;
use App\Enums\SaveResult;
use App\Http\Requests\ChangePasswordRequest;
use App\Enums\ChangePasswordResult;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('company');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.saludo');
    }

    public function profile()
    {
        $company = Company::where('contact_email', Auth::user()->email)->first();
        //$company_type = CompanyType::where('id' , $company->company_type_id)->first();
        $company_types = CompanyType::all();
        return view('company.profile', [
            'company' => $company,
            'company_types' => $company_types
        ]);
    }

    public function editProfile(Request $request)
    {
        if (CompanyBL::editCompany($request->all(), Auth::user()->email)) {
            return redirect('company/profile')->with('sucess', 'Datos guardados correctamente.');
        }

        return redirect('company/profile')->with('error', 'Los datos no pudieron ser guardados.');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $result = CompanyBL::changePassword($request->all(), Auth::user()->id);

        switch ($result) {
            case ChangePasswordResult::SUCCESS:
                return redirect('company/profile')->with('sucess', 'Contrase&ntilde;a cambiada correctamente.');
                break;
            case ChangePasswordResult::OLDPASSWORD_ERROR:
                return redirect('company/profile')->with('error', 'El password anterior no es correcto.');
                break;
            case ChangePasswordResult::INTERNAL_ERROR:
                return redirect('company/profile')->with('error', 'Error interno consulte al administrador.');
                break;
        }
    }

}
