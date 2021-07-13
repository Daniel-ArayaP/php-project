<?php

namespace App\Http\Controllers\Auth;

use App\BL\TutorBL;
use App\Enums\CompanyRegisterResult;
use App\Enums\SaveResult;
use DB;
use \Datetime;

use App\BL\StudentBL;
use App\BL\CompanyBL;
use App\BL\AdminBL;
use App\BL\RegistroBL;
use App\BL\InstituteBL;

use App\Models\Gender;
use App\Models\ProcessType;
use App\Models\CompanyType;
use App\Models\Role;
use App\Models\Company;

use App\Enums\StudentRegisterResult;

use App\Models\Sede;
use App\Security\SecurityHelper;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Rules\CollegeEmail;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\RegisterCompanyRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Http\Requests\RegisterInstituteRequest;
use App\Http\Requests\RegisterRegistroRequest;
use App\Models\Tutor;
use App\Models\Admin;

use Illuminate\Auth\Events\Registered;
use App\Models\Period;

use Mail;
use App\Mail\NewCompanyCreated;
use App\Mail\NewStudentCreated;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Adonde redirigir los usuarios después del registro.
     *
     * @var string
     */
    protected $redirectTo = '/createproject';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Muestra la vista de pre-registro para seleccionar el tipo de usuario a registrar.
     */
    public function registerSelect()
    {
        return view('auth.registerSelect');
    }


    /**
     * Muestra la aplicación de registro para estudiantes
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $genders = Gender::all();
        $process = ProcessType::all();

        $roles = Role::all();
        return view('auth.Estudiante', [
            'genders' => $genders,
            'process' => $process,
            'roles' => $roles
        ]);
    }


    /**
     * Manejo del registro del estudiante
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function registroEstudiante(RegisterStudentRequest $request)
    {
        $result = StudentBL::createStudent($request->all());

        switch ($result) {
            case StudentRegisterResult::SUCCESS:
                return redirect()
                    ->route('login')
                    ->with('sucess', 'Valla!!! Ahora para finalizar el registro por favor valide el usuario vía email????');
            case StudentRegisterResult::INTERNAL_ERROR:
                return redirect()->route('login')->with('error', 'El estudiante no pudo ser creado.');
        }
    }


    /**
     * Manejo de la activación del estudiante
     *
     * @param $encodeid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activarEstudiante($encodeid)
    {
        $id = base64_decode($encodeid);
        DB::table('users')
            ->where('id', $id)
            ->update(['is_active' => 1, 'is_locked_out' => 0]);

        $StudentName = DB::table('person_profiles')->where('id', $id)->value('first_name');
        $StudentLastname = DB::table('person_profiles')->where('id', $id)->value('last_name1');
        $Studentsecondlastname = DB::table('person_profiles')->where('id', $id)->value('last_name2');
        $Student = $StudentName . ' ' . $StudentLastname . ' ' . $Studentsecondlastname;

        //Mail::to(env('MAIL_USERNAME'))->send(new NewStudentCreated($Student));

        //return redirect()->route('login');
        return redirect()->route('login')->with('sucess', 'El estudiante ha sido activado exitosamente.');
    }


    /**c
     * Muestra la aplicación de registro para empresa.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCompanyRegistrationForm()
    {
        $company_types = CompanyType::all();
        $roles = Role::all();
        return view('auth.Compania', [
            'company_types' => $company_types,
            'roles' => $roles
        ]);
    }


    /**
     * Manejo del registro de la empresa.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function registerCompany(RegisterCompanyRequest $request)
    {
        $result = CompanyBL::createCompany($request->all());

        switch ($result) {
            case CompanyRegisterResult::SUCCESS:
                return redirect()
                    ->route('login')
                    ->with('sucess', 'Para finalizar el registro por favor valide la empresa vía email.');
            case CompanyRegisterResult::INTERNAL_ERROR:
                return redirect()->route('login')->with('error', 'La empresa no se pudo crear.');
        }

        return redirect()->route('login')->with('error', 'La empresa ya existe.');
    }


    /**
     * Manejo de la activación de la empresa.
     * @return \Illuminate\Http\RedirectResponse
     */

    public function activarEmpresa($encodeid)
    {
        $id = base64_decode($encodeid);
        DB::table('users')
            ->where('id', $id)
            ->update(['is_active' => 1, 'is_locked_out' => 0]);

        $CompanyContactName = DB::table('person_profiles')->where('id', $id)->value('first_name');
        $CompanyContactLastname = DB::table('person_profiles')->where('id', $id)->value('last_name1');
        $CompanyContactSecondlastname = DB::table('person_profiles')->where('id', $id)->value('last_name2');
        $Company = $CompanyContactName . ' ' . $CompanyContactLastname . ' ' . $CompanyContactSecondlastname;

        Mail::to(env('MAIL_USERNAME'))->send(new NewCompanyCreated($Company));

        return redirect()->route('login')->with('sucess', "¡Su cuenta ha sido activada exitosamente! Por favor ingrese al sistema.");
    }







    // ------ G1


    /**
     * Crea una nueva instancia empresa para empresa
     *
     * @param array $data
     * @return \App\Company
     */
    protected function createCompany(array $data)
    {
        return CompanyBL::createCompany($data);
    }


    /**
     * Muestra la aplicación de registro para administrador.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminRegistrationForm()
    {
        return view('auth.Admin');
    }


    /**
     * Manejo del registro de administrador
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function registerAdmin(RegisterAdminRequest $request)
    {
        $result = AdminBL::createAdmin($request->all());

        switch ($result) {
            case StudentRegisterResult::SUCCESS:
                return redirect()->route('login')->with('sucess', 'Administrador ingresado correctamente. Espere a ser desbloqueado.');
            case StudentRegisterResult::INTERNAL_ERROR:
                return redirect()->route('login')->with('error', 'El administrador no pudo ser creado.');
        }
    }


    /**
     * Muestra la aplicación de registro para profesor.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfessorRegistrationForm()
    {
        return view('admin.registerProfessor');
    }


    /**
     * Manejo del registro de profesor.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function registerProfessor(Request $request)
    {
        $result = TutorBL::createTutor($request->all());
//        dd($result);
        switch ($result) {
            case SaveResult::SUCCESS:
                return redirect()->route('login')->with('sucess', 'Profesor ingresado correctamente. Espere a ser desbloqueado.');
            case SaveResult::INTERNAL_ERROR:
                return redirect()->route('login')->with('error', 'El Profesor no pudo ser creado.');
        }
    }


    //Aqui devuelvo la vista de registro
    public function showRegisterRegistrationForm()
    {
        return view('auth.Registro');
    }

    public function registerRegistro(RegisterRegistroRequest $request)
    {
        $result = RegistroBL::createAdmin($request->all());
        switch ($result) {
            case StudentRegisterResult::SUCCESS:
                return redirect()->route('login')->with('sucess', 'Usuario registro ingresado correctamente. Espere a ser desbloqueado!!');
            case StudentRegisterResult::INTERNAL_ERROR:
                return redirect()->route('login')->with('error', 'El registro no pudo ser creado.');
        }
    }


    public function showRegisterInstituteForm()
    {


        $sedes = Sede::all();  // get data from table, which is define in model "Institucion"
        return view('institute.registerInstitute', [
            'sedes' => $sedes
        ]);  // sent data to view

    }

    public function registerInstitute(RegisterInstituteRequest $request)
    {
        $usernames = \DB::table("users")->where([
            ['email', '=', $request['emailInstitute']]
        ])->first();


        if (is_null($usernames)) {
            event(new Registered($user = $this->createInstitute($request->all())));
            return redirect()->route('login');
        } elseif ($usernames->email === $request['emailInstitute']) {
            return redirect()->route('registerInstitute')->with('error', 'El usuario ya se encuentra registrado.');
        }


    }

    public function createInstitute(array $data)
    {
        return InstituteBL::createInstitute($data);
    }

}
