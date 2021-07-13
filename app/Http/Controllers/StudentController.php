<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\PersonProfile;
use App\Models\Gender;
use Illuminate\Support\Facades\Auth;
use App\BL\StudentBL;
use App\Http\Requests\ChangePasswordRequest;
use App\Enums\ChangePasswordResult;
use App\Models\Tutor; 

class StudentController extends Controller
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
        return view('student.home');
    }

    /**
     * Show the logged user profile data
     */
    public function profile()
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        $personProfile = PersonProfile::where('id', $student->person_profile_id)->first();
        $genders = Gender::all();
        $tutor = Tutor::all();

        return view('student.profile', [
            'student' => $student,
            'personProfile' => $personProfile,
            'genders' => $genders,
            'tutors'=> $tutor
        ]);
    }

    public function editProfile(Request $request)
    {
        if (StudentBL::editStudent($request->all(), Auth::user()->id)) {
            return redirect('student/profile')->with('sucess', 'Datos guardados correctamente.');
        }

        return redirect('student/profile')->with('error', 'Los datos no pudieron ser guardados.');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $result = StudentBL::changePassword($request->all(), Auth::user()->id);

        switch ($result) {
            case ChangePasswordResult::SUCCESS:
                return redirect('student/profile')->with('sucess', 'Contrase&ntilde;a cambiada correctamente.');
                break;
            case ChangePasswordResult::OLDPASSWORD_ERROR:
                return redirect('student/profile')->with('error', 'El password anterior no es correcto.');
                break;
            case ChangePasswordResult::INTERNAL_ERROR:
                return redirect('student/profile')->with('error', 'Error interno consulte al administrador.');
                break;
        }
    }


    public function addCurriculum(Request $request, $idProject)
    {
        if (StudentBL::addCurriculumStudent($request->all(), Auth::user()->id)) {

            return redirect()->route('editCompanyProjectStudents', $idProject)->with('sucess', 'Se adjunto correctamente el currículo a su perfil');
        }

        return redirect()->route('editCompanyProjectStudents', $idProject)->with('error', 'No se pudo adjuntar el currículo a su perfil');
    }


    public function addTutor(Request $request, $idProject)
    {
        if (StudentBL::addTutorStudent($request->all(), Auth::user()->id)) {

            return redirect()->route('editCompanyProjectStudents', $idProject)->with('sucess', 'Tutor sugerido guardado correctamente');
        }

        return redirect()->route('editCompanyProjectStudents', $idProject)->with('error', 'El tutor sugerido no se pudo guardar');
    }



//    public function downloadCurriculum()
//    {
//        $url = DB::table('students')->where('user_id', Auth::user()->id)->value('curriculum');
//        return response()->download(storage_path('app/public/' . $url . ''));
//    }


    public function downloadCurriculum()
    {
        $curriculum  = DB::table('students')->where('user_id', Auth::user()->id)->value('curriculum');

        return Storage::Disk('public')->download($curriculum);
//        return Storage::Disk('local')->download($curriculum);
    }


}
