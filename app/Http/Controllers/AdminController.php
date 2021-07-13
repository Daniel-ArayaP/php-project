<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProcessType;
use App\Models\Gender;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Modality;
use App\Models\Student;
use App\BL\StudentBL;
use App\BL\CompanyBL;
use Illuminate\Support\Facades\DB;
use App\BL\AdminBL;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordRequest;
use App\Enums\ChangePasswordResult;
use App\Models\Period;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $process = ProcessType::all();
        $modality = Modality::all();
        $periods = Period::all();
        $students = Student::all();

        return view('admin.home',[
            'process' => $process,
            'modality' => $modality,
            'students' => $students,
            'periods' => $periods
        ]);
    }

    public function filterStudents(Request $request)
    {

        $process = ProcessType::all();
        $modality = Modality::all();
        $periods = Period::all();
        $students = Student::all();

        $data = $request->all();

        if ($data['process'] == '3') {
            $students = Student::where('tcu_registered', 1)->get();
        } elseif ($data['process'] == '4') {
            $students = Student::where('pes_registered', 1)->get();
        } elseif ($data['process'] == '5') {
            $students = Student::where('tfg_registered', 1)->get();
        }

        return view('admin.home',[
            'process' => $process,
            'modality' => $modality,
            'students' => $students,
            'periods' => $periods
        ]);
    }


    public function indexCompanies(Request $request)
    {

        $companies = Company::all();

        return view('admin.homeCompany',[
            'companies' => $companies
        ]);
    }

    public function profile()
    {
        $admin = Admin::where('user_id', Auth::user()->id)->first();

        return view('admin.profile', [
            'admin' => $admin
        ]);
    }

    public function editProfile(Request $request)
    {
        if (AdminBL::editAdmin($request->all(), Auth::user()->id)) {
            return redirect('admin/profile')->with('sucess', 'Datos guardados correctamente.');
        }

        return redirect('admin/profile')->with('error', 'Los datos no pudieron ser guardados.');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $result = AdminBL::changePassword($request->all(), Auth::user()->id);

        switch ($result) {
            case ChangePasswordResult::SUCCESS:
                return redirect('admin/profile')->with('sucess', 'Contrase&ntilde;a cambiada correctamente.');
                break;
            case ChangePasswordResult::OLDPASSWORD_ERROR:
                return redirect('admin/profile')->with('error', 'El password anterior no es correcto.');
                break;
            case ChangePasswordResult::INTERNAL_ERROR:
                return redirect('admin/profile')->with('error', 'Error interno consulte al administrador.');
                break;
        }
    }



    public function adminProjects(Request $request)
    {
        $activePeriod = Period::where('active', true)->first();
        $process = ProcessType::all();
        $periods = Period::all();
        $data = $request->all();
        $periodId = [];

        if (isset($data['period'])) {
            $periodId = $data['period'];
        }
        else {
            $periodId = $activePeriod->id;
        }

        $request->flash();
        $result = AdminBL::adminProjects($data);

        $projects = $result->get();

        return view('admin.adminProjects',[
            'process' => $process,
            'periods' => $periods,
            'projects' => $projects,
            'periodId' => $periodId
        ]);
    }



}
