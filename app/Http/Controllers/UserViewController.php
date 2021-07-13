<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Company;
use App\Models\Admin;
use App\Models\User;
use App\Models\Period;
use App\Models\Project;
use App\Models\ProcessType;
use App\BL\StudentBL;
use App\BL\CompanyBL;
use App\BL\AdminBL;
use App\Enums\StudentRegisterResult;
use App\Models\Tutor; 

use App\BL\RegistroBL;
use App\Http\Middleware\Registro;

use Mail;
use App\Mail\CompanyUnlocked;
use App\Mail\StudentActivate;
use DB;

class UserViewController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $period = Period::where('active', true)->first();
        $student = Student::find($id);
        $tutors = $student->tutors()->where('period_id', '=', $period->id)->get();
        $tutor = DB::table('students')->where('person_profile_id',$id)->value('tutor_profile_id');

        $projects = Project::where('student_id', '=', $student->person_profile_id)->get();
        $processTypes = ProcessType::all();

        return view('studentsview.index', [
            'student' => $student,
            'tutors' => $tutors,
            'tutor' => $tutor, 
            'projects' => $projects,
            'process' => $processTypes,
            'period' => $period
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCompanies($id)
    {
        $company = Company::find($id);
        $user = User::where('email', $company['contact_email'])->first();
        return view('companiesview.index', [
            'company' => $company,
            'user' => $user
        ]);
    }

    public function indexAdminUsers($id)
    {
        $user = Admin::find($id);
        return view('adminusers.view', [
            'user' => $user
        ]);
    }

    public function indexRegisterUsers($id)
    {
            $user = Admin::find($id);
            return view('registerusers.view', [
                'user' => $user
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerProcess(Request $request)
    {
        $data = $request->all();
        $result = StudentBL::register($data);

        switch ($result) {
            case StudentRegisterResult::SUCCESS:
//                        dd($result);

            return redirect()->route('adminHome')->with('success', 'Estudiante registrado.');
            case StudentRegisterResult::ALREADY_REGISTERED:
                return redirect()->route('usersView', ['id' => $data['id']])->with('error', 'El estudiante no puede ser registrado en este proceso!!');
            case StudentRegisterResult::NO_DATA:
                return redirect()->route('usersView', ['id' => $data['id']])->with('error', 'Debe seleccionar un proceso.');
            case StudentRegisterResult::INTERNAL_ERROR:
                return redirect()->route('usersView', ['id' => $data['id']])->with('error', 'Wowww, El estudiante no pudo ser registrado!');
        }
    }

    public function NotificationActivateStudent($id)
    {
        $pemail=DB::table('students')->where('person_profile_id',$id)->value('personal_email');
        $uemail=DB::table('students')->where('person_profile_id',$id)->value('university_email');
        //Mail::to($pemail)->send(new StudentActivate);
        //Mail::to($uemail)->send(new StudentActivate);
        return redirect()->route('usersView',  $id)->with('sucess', 'Estudiante desbloqueado.');
    }


    public function activate(Request $request)
    {
        $data = $request->all();
        $result = StudentBL::activate($data);
        
        switch ($result) {
            case StudentRegisterResult::SUCCESS:
                return redirect()->route('usersView', ['id' => $data['id']])->with('sucess', 'Estudiante desbloqueado.');
            case StudentRegisterResult::INTERNAL_ERROR:
                return redirect()->route('usersView', ['id' => $data['id']])->with('error', 'Disculpe , pero el estudiante no pudo ser registrado por error interno.');
        }
    }

    public function activateCompany(Request $request)
    {
        $data = $request->all();
        $result = CompanyBL::activateCompany($data);
        
        switch ($result) {
            case StudentRegisterResult::SUCCESS:
                return redirect()->route('unlockCompany', ['id' => $data['id']]);
            case StudentRegisterResult::INTERNAL_ERROR:
                return redirect()->route('companiesView', ['id' => $data['id']])->with('error', 'La empresa no pudo ser desbloqueada por error interno.');
        }
    }

    public function activateAdminUser(Request $request)
    {
        $data = $request->all();
        $result = AdminBL::activate($data);
        
        switch ($result) {
            case StudentRegisterResult::SUCCESS:
                return redirect()->route('adminUsers', ['id' => $data['id']])->with('sucess', 'Administrador desbloqueado.');
            case StudentRegisterResult::INTERNAL_ERROR:
                return redirect()->route('adminUsers', ['id' => $data['id']])->with('error', 'El administrador no pudo ser desbloqueado por error interno.');
        }
    }

    public function unlockCompany($id)
    {
        $searchActivate = DB::table ('companies')->where('id',$id)->value('contact_email');
        $email=$searchActivate;
        Mail::to($email)->send(new CompanyUnlocked);
        return redirect()->route('companiesView',$id)->with('sucess', 'Empresa desbloqueada.');
     }

    public function activateRegisterUser(Request $request)
    {
        $data = $request->all();
        $result = RegistroBL::activate($data);
        switch ($result) {
            case StudentRegisterResult::SUCCESS:
                return redirect()->route('registerUsers', ['id' => $data['id']])->with('sucess', 'Usuario registro desbloqueado.');
            case StudentRegisterResult::INTERNAL_ERROR:
                return redirect()->route('registerUsers', ['id' => $data['id']])->with('error', 'Usuario registro no pudo ser desbloqueado por error interno.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $result = StudentBL::updatePeriod($id);

        if (!$result) {
            return redirect()->route('usersView', ['id' => $id])->with('error', 'El periodo no pudo ser actualizado.');
        }

        return redirect()->route('usersView', ['id' => $id])->with('sucess', 'Periodo actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
