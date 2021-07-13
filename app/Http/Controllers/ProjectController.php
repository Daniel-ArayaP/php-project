<?php

namespace App\Http\Controllers;

use App\BL\ProjectBL;
use App\Mail\CambiodeEstadoSolicitudAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CompanyType;
use App\Models\ProjectType;
use App\Models\Project;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\ActivateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\ProcessType;
use App\Models\Modality;
use App\BL\ParticipanteBL;
use App\Models\Solicitud;
use App\Models\Participante;
use App\BL\SolicitudBL;
use App\Models\Tutor;
use App\Models\PersonProfile;
use App\Models\Period;
use Mail;
use App\Mail\NewProject;
use App\Mail\ProjectStatusChanged;
use App\Mail\SolicitudEnviada;
use App\Mail\CambiodeEstadoSolicitud;
use App\Mail\ReportStudentPerformance;
use Illuminate\Support\Facades\Input;

class ProjectController extends Controller
{
    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * index
     */
    public function index()
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        if (Auth::user()->role_id === 1) {
            $projects = Project::all();
        } else {
            $projects = Project::where('student_id', $student->person_profile_id)->get();
        }

        return view('project.index', [
            "projects" => $projects
        ]);
    }


    /**
     * indexCompany
     */
    public function indexCompany()
    {
        $company = DB::select('select * from companies where contact_email = :contact_email', ['contact_email' => Auth::user()->email]);
        $projects = Project::where('company_id', $company[0]->id)->get();

        return view('project.indexCompany', [
            "projects" => $projects
        ]);
    }


    /**
     * indexCompanyPendingApprovals
     */
    public function indexCompanyPendingApprovals()
    {

        $company = DB::select('select * from companies where contact_email = :contact_email', ['contact_email' => Auth::user()->email]);
        $id = $company[0]->id;
        $projects = Project::select('projects')
            ->join('solicitudes', 'projects.id', '=', 'solicitudes.project_id')
            ->where('solicitudes.status_id', '=', 7)
            ->where('solicitudes.company_id', '=', $id)
            ->select('projects.*')
            ->get();

        //dd($projects);

        return view('project.indexCompanyPendingApproval', [
            "projects" => $projects,
            "id" => $id,
        ]);
    }


    /**
     * create
     */
    public function create()
    {
        $companyTypes = CompanyType::all();
        $projectTypes = ProjectType::all();
        $processTypes = ProcessType::All();
        $modalities = Modality::All();
        $periods = Period::all();
        $projects = Project::all()->first();


        $selectedPeriod = Period::whereId($projects->period_id)->first()->period;


        switch (Auth::user()->role_id) {
            case (2):
                return view('project.create', [
                    "companyTypes" => $companyTypes,
                    "projectTypes" => $projectTypes,
                    "processTypes" => $processTypes,
                    "modalities" => $modalities,
                    "periods" => $periods,
                    "projects" => $projects,
                    "selectedPeriod" => $selectedPeriod
                ]);
                break;
            case (3):
                $company = Company::where('contact_email', Auth::user()->email)->first();

                return view('project.createCompanyProject', [
                    "company" => $company,
                    "companyTypes" => $companyTypes,
                    "projectTypes" => $projectTypes,
                    "processTypes" => $processTypes,
                    "modalities" => $modalities,
                    "periods" => $periods,
                    "projects" => $projects,
                    "selectedPeriod" => $selectedPeriod

                ])->with('sucess', '¡El proyecto fue creado exitosamente! Nos pondremos en contacto cuando haya sido aprobado.');

                //Mail::to(env('MAIL_USERNAME'))->send(new NewCompanyCreated($Project));
                break;
            default:
                break;
        }
        return redirect('index')->with('error', 'El proyecto no pudo ser creado.');
    }


    /**
     * store
     */
    public function store(CreateProjectRequest $request)
    {
        if (ProjectBL::createProject($request->all(), $request->file('projectFile'))) {
            return redirect('studentHome')->with('sucess', 'Proyecto creado correctamente.');
        }

        return redirect('studentHome')->with('error', 'El proyecto no pudo ser creado.');
    }


    /**
     * destroy
     */
    public function destroy($id)
    {
//        dd($id);
        if (ProjectBL::deleteProject($id)) {
            return redirect('project')->with('sucess', 'Propuesta eliminado correctamente.');
        }

        return redirect('project')->with('error', 'La propuesta no pudo ser eliminada.');
    }


    /**
     *changeStatus
     */
    public function changeStatus(Request $request, $id)
    {
        $data = $request->all();
        if ($data['status'] == 'Aprobado') {
            $status_id = 2;
        } else {
            $status_id = 3;
        }

        if (ProjectBL::changeProjectStatus($id, $status_id)) {
            return redirect('project')->with('sucess', 'Estado de Proyecto cambiado correctamente.');
        }

        return redirect('project')->with('error', 'El proyecto no pudo cambiar su estado.');
    }


    /**
     * @param CreateProjectRequest $request
     * @return mixed
     */
    public function storeCompany(CreateProjectRequest $request)
    {

        if (ProjectBL::createProjectCompany($request->all()))
            return redirect()->route('NewProject');

        return redirect('projectsCompany')->with('error', 'El proyecto no pudo ser creado.');

    }



    /**
     * @return mixed
     */
    //envio de correo notificando la creacion de un proyecto nuevo
    public function NewProject()
    {
        $searchProject = DB::table('projects')->orderBy('created_at', 'desc')->value('title');
        $tile = $searchProject;
        $searchcompanyid = DB::table('projects')->orderBy('created_at', 'desc')->value('company_id');
        $searchcompany = DB::table('companies')->where('id', $searchcompanyid)->value('name');
        $company = $searchcompany;
        $searchadmin = DB::table('admins')->where('email', 'like', '%@%')->pluck('email');

        //Mail::to(env('MAIL_USERNAME'))->send(new NewProject($tile, $company));
        return redirect('projectsCompany')->with('sucess', 'Proyecto creado correctamente.');
    }


    /**
     * @param $file
     * @return mixed
     */
    public function download($file)
    {
        $url = public_path() . "/storage/{$file}";
        $name = 'Propuesta.pdf';
        $headers = ['Content-Type: application/pdf'];
        return response()->download($url, $name, $headers);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $companyTypes = CompanyType::all();
        $projectTypes = ProjectType::all();
        $processTypes = ProcessType::All();
        $modalities = Modality::All();
        $periods = Period::all();

        return view('project.create', [
            "companyTypes" => $companyTypes,
            "projectTypes" => $projectTypes,
            "project" => $project,
            "processTypes" => $processTypes,
            "modalities" => $modalities,
            "periods" => $periods
        ]);
    }


    /**
     * editCompanyProject
     */
    public function editCompanyProject($id)
    {
        $project = Project::find($id);
        $company = Company::where('id', $project->company_id)->first();
        $companyTypes = CompanyType::all();
        $projectTypes = ProjectType::all();
        $processTypes = ProcessType::All();
        $modalities = Modality::All();
        $periods = Period::all();

        $selectedPeriod = Period::whereId($project->period_id)->first()->period;


        $solicitudes = DB::table('solicitudes')->where('project_id', $project->id)->value('person_profile_id');
        $students = DB::table('person_profiles')->where('id', $solicitudes);
        $solicitud = Solicitud::where('project_id', $project->id)->get();
        $participante = Participante::where('participant_project_id', $project->id)->get();

        return view('project.createCompanyProject', [
            "companyTypes" => $companyTypes,
            "company" => $company,
            "projectTypes" => $projectTypes,
            "project" => $project,
            "processTypes" => $processTypes,
            "modalities" => $modalities,
            "solicitud" => $solicitud,
            "participante" => $participante,
            "student" => $students,
            "periods" => $periods,
            "selectedPeriod" => $selectedPeriod
        ]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function editCompanyProjectAdmin($id)
    {
        $project = Project::find($id);
        $company = Company::where('id', $project->company_id)->first();
        $companyTypes = CompanyType::all();
        $projectTypes = ProjectType::all();
        $processTypes = ProcessType::All();
        $modalities = Modality::All();
        $participante = Participante::where('participant_project_id', $project->id)->get();

        return view('project.createCompanyProjectAdmin', [
            "companyTypes" => $companyTypes,
            "company" => $company,
            "projectTypes" => $projectTypes,
            "project" => $project,
            "processTypes" => $processTypes,
            "participante" => $participante,
            "modalities" => $modalities
        ]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function editCompanyProjectStudents($id)
    {

        $studentId = Auth::user()->id;
        $studentCurriculum = DB::table('students')->where('user_id', $studentId)->first();

        $tutors = Tutor::all();

        $student = Student::find($id);
        $project = Project::find($id);
        $company = Company::where('id', $project->company_id)->first();
        $companyTypes = CompanyType::all();
        $projectTypes = ProjectType::all();
        $processTypes = ProcessType::All();
        $modalities = Modality::All();
        $participante = Participante::where('participant_project_id', $project->id)->get();
        $participantes = DB::table('participantes')->where('participant_project_id', $project->id)->count();


        if ($studentCurriculum->curriculum and $studentCurriculum->tutor_profile_id) {
            return view('project.createCompanyProjectStudents', [
                "companyTypes" => $companyTypes,
                "company" => $company,
                "projectTypes" => $projectTypes,
                "project" => $project,
                "processTypes" => $processTypes,
                "participante" => $participante,
                "modalities" => $modalities,
                "particioantes" => $participantes,
                "student" => $student,
                "studentCurriculum" => $studentCurriculum,
                "tutors" => $tutors
            ]);
        } else
            redirect()->route('editCompanyProjectStudents', $project->id)->with('error', '¡Encontramos un problema! Por favor provea los datos requeridos.');
            return view('project.createCompanyProjectStudents', [
                "companyTypes" => $companyTypes,
                "company" => $company,
                "projectTypes" => $projectTypes,
                "project" => $project,
                "processTypes" => $processTypes,
                "participante" => $participante,
                "modalities" => $modalities,
                "particioantes" => $participantes,
                "student" => $student,
                "studentCurriculum" => $studentCurriculum,
                "tutors" => $tutors
            ]);


    }


    /**
     * @param CreateProjectRequest $request
     * @param $id
     * @return mixed
     */
    public function update(CreateProjectRequest $request, $id)
    {
        $result = ProjectBL::editProject($request->all(), ($request->hasFile('projectFile') ? $request->file('projectFile') : null));

        if ($result) {
            return redirect('project')->with('sucess', 'Excelente se han guardado los cambios');
        }

        return redirect('project')->with('error', 'Los datos no pudieron ser guardados, intenta de nuevo');
    }


    /**
     * @param CreateProjectRequest $request
     * @param $id
     * @return mixed
     */
    public function updateCompanyProject(CreateProjectRequest $request, $id)
    {

        if (Input::get('teleworking') == null) {
            // El usuario NO marcó el chechbox
            $request->request->add(['teleworking' => '0']);
        } else {
            $request['teleworking'] = '1';
        }

        $result = (ProjectBL::editProjectCompany($request->all()));

        if ($result) {
            return redirect('projectsCompany')->with('sucess', 'Cambios guardados correctamente.');
        }

        return redirect('projectsCompany')->with('error', 'Los datos no pudieron ser guardados.');
    }


    /**
     * @param ActivateProjectRequest $request
     * @return mixed
     */
    public function updateCompanyProjectAdmin(ActivateProjectRequest $request)
    {
        $result = (ProjectBL::editProjectCompanyAdmin($request->all()));

        $id = $request->projectId;

        if ($result) {
            return redirect()->route('Notification', ['id' => $id]);
        }
    }


    /**
     * @param $id
     * @return mixed
     */
    public function rejectCompanyProjectAdmin($id)
    {
        $result = ProjectBL::rejectProjectCompanyAdmin($id);
        return redirect()->route('Notification', ['id' => $id]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function details($id)
    {
        $project = Project::find($id);

        return view('project.details', [
            "project" => $project
        ]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function acceptProject($id)
    {
        $result = ProjectBL::acceptRejectProject($id, 3);

        if (!$result) {
            return redirect()->route('projectDetails', ['id' => $id])->with('error', 'No se pudo cambiar el estado del proyecto.');
        }

        return redirect()->route('projectDetails', ['id' => $id])->with('sucess', 'El proyecto ha sido aceptado.');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function rejectProject($id)
    {
        $result = ProjectBL::acceptRejectProject($id, 4);

        if (!$result)
            return redirect()->route('projectDetails', ['id' => $id])->with('error', 'No se pudo cambiar el estado del proyecto.');


        return redirect()->route('projectDetails', ['id' => $id])->with('error', 'El proyecto ha sido rechazado.');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function Notification($id)
    {
        $searchProjectname = DB::table('projects')->where('id', $id)->value('title');
        $title = $searchProjectname;
        $searchstatusid = DB::table('projects')->where('id', $id)->value('status_id');
        $searchstatus = DB::table('status')->where('id', $searchstatusid)->value('name');
        $status = $searchstatus;
        $searchcompanyid = DB::table('projects')->where('id', $id)->value('company_id');
        $company = DB::table('companies')->where('id', $searchcompanyid)->value('contact_email');

        //Mail::to($company)->send(new ProjectStatusChanged($status, $title));

        if ($searchstatusid === 2) {
            return redirect()->route('companiesReport')->with('sucess', 'Proyecto aprobado.');
        }
        else {
            return redirect()->route('companiesReport')->with('error', 'Proyecto Rechazado.');
        }
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function setGrade(Request $request)
    {
        $data = $request->all();
        $result = ProjectBL::setProjectGrade($data['id'], $data['grade']);

        if (!$result) {
            return redirect()->route('projectDetails', ['id' => $data['id']])->with('error', 'No se pudo calificar el proyecto.');
        }

        return redirect()->route('projectDetails', ['id' => $data['id']])->with('sucess', 'El proyecto a sido calificado.');
    }












    /**
     * @param CreateProjectRequest $request
     * @param $id
     * @return mixed
     */
    //se crea la solicitud para solicitar campo en un proyecto
    public function updateCompanyProjectStudents(CreateProjectRequest $request, $id)
    {
        $student = DB::select('select * from students where university_email = :email', ['email' => Auth::user()->email]);
        $solicitud = DB::table('solicitudes')
            ->where('project_id', $id)
            ->where('person_profile_id', $student[0]->person_profile_id)
            ->value('person_profile_id');

        $estado = DB::table('participantes')
            ->where('person_profile_id', $student[0]->person_profile_id)
            ->count();

        if ($student[0]->person_profile_id == $solicitud) {
            return redirect()->route('editCompanyProjectStudents', $id)->with('error', 'No se puede enviar una solicitud dos veces.');
        }

        if ($estado >= 1)
            return redirect()->route('editCompanyProjectStudents', $id)->with('error', 'ya fue aceptado por una empresa.');

        $result = (SolicitudBL::create($request->all(), $student));

        if ($result)
            return redirect()->route('notificacionsolicitud', $id);


        return redirect()->route('editCompanyProjectStudents', $id)->with('error', 'Error al enviar la solicitud.');
    }




    /**
     * @param $id
     * @return mixed
     */
    //Envio de correo electronico a la empresa notificando de que un estudiante quiere
    //ingresar a su proyecto
    public function notificacionsolicitud($id)
    {
        $companyid = DB::table('projects')->where('id', $id)->value('company_id');
        $company = DB::table('companies')->where('id', $companyid)->value('contact_email');
        $project = DB::table('projects')->where('id', $id)->value('title');
        $searchStudent = DB::table('students')->where('university_email', Auth::user()->email)->value('person_profile_id');
        $StudentName = DB::table('person_profiles')->where('id', $searchStudent)->value('first_name');
        $StudentLastname = DB::table('person_profiles')->where('id', $searchStudent)->value('last_name1');
        $Studentsecondlastname = DB::table('person_profiles')->where('id', $searchStudent)->value('last_name2');
        $curriculum = DB::table('solicitudes')->where('person_profile_id', $searchStudent)->value('curriculum');
        $Student = $StudentName . ' ' . $StudentLastname . ' ' . $Studentsecondlastname;

        Mail::to($company)->send(new SolicitudEnviada($Student, $curriculum, $project));

        return redirect()->route('companiesReportStudents')->with('sucess', 'Solicitud enviada correctamente');
    }



    /**
     * @param $id_solicitud
     * @return mixed
     */
    //descarga de archivo hoja de vida del estudiante
    public function downloadfileC($id_solicitud)
    {
        $url = DB::table('solicitudes')->where('id', $id_solicitud)->value('curriculum');
        $file = Storage::disk('public')->get($url);
//        $file = Storage::disk('local')->get($url);

        return response()->download(storage_path('app/public/' . $url . ''));
    }



    /**
     * @param $id_solicitud
     * @return mixed
     */
    //el estudiante cancela la solicitud de unirse a un proyecto
    public function deleteSolicitud($id_solicitud)
    {
        $url = DB::table('solicitudes')->where('id', $id_solicitud)->delete();
        return redirect()->route('solicitudesreportstudents')->with('sucess', 'Solicitud Eliminada Correctamente');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function aceptSolicitud($id)
    {
        $student = DB::table('solicitudes')->where('id', $id)->value('person_profile_id');
        $participante = DB::table('participantes')->where('person_profile_id', $student)->value('person_profile_id');
        $project = DB::table('solicitudes')->where('id', $id)->value('project_id');
        $quantity = DB::table('projects')->where('id', $project)->value('students_quantity');
        $countstudents = DB::table('participantes')->where('participant_project_id', $project)->count();

        if ($student != $participante and $quantity != $countstudents) {
            $result = SolicitudBL::aceptSolicitud($id, $student);
            $result = ParticipanteBL::create($id);

            return redirect()->route('notificarsolicitud', ['id' => $id]);
        } else
            return redirect()->route('editCompanyProject', ['id' => $project])->with('error', 'El estudiante participa en otro proyecto');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function rejectSolicitud($id)
    {
        $result = SolicitudBL::rejectSolicitud($id);
        return redirect()->route('notificarsolicitud', ['id' => $id]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function notificarsolicitud($id)
    {
        $project = DB::table('solicitudes')->where('id', $id)->value('project_id');
        $solicitud = DB::table('solicitudes')->where('id', $id)->value('status_id');
        $estado = DB::table('status')->where('id', $solicitud)->value('name');
        $projectname = DB::table('projects')->where('id', $project)->value('title');
        $student = DB::table('solicitudes')->where('id', $id)->value('person_profile_id');

        $nombreStudent = DB::table('person_profiles')->where('id', $student)->value('first_name');
        $apellido1Student = DB::table('person_profiles')->where('id', $student)->value('last_name1');
        $apellido2Student = DB::table('person_profiles')->where('id', $student)->value('last_name2');
        $nombreCompletoStudent = $nombreStudent . ' ' . $apellido1Student . ' ' . $apellido2Student;

        $pemail = DB::table('students')->where('person_profile_id', $student)->value('personal_email');
        $uemail = DB::table('students')->where('person_profile_id', $student)->value('university_email');

        if ($solicitud == 5) {    //id correspondiente al estado solicitud "Aceptada" de la tabla [status]
            Mail::to($pemail)->send(new CambiodeEstadoSolicitud($estado, $projectname));
            Mail::to($uemail)->send(new CambiodeEstadoSolicitud($estado, $projectname));

             Mail::to(env('MAIL_USERNAME'))->send(new CambiodeEstadoSolicitud($estado, $projectname));

            return redirect()->route('editCompanyProject', ['id' => $project])->with('sucess', 'Solicitud Aceptada');

        } elseif ($solicitud == 6) {    //id correspondiente al estado solicitud "Declinada" de la tabla [status]


          Mail::to(env('MAIL_USERNAME'))->send(new CambiodeEstadoSolicitud($estado, $projectname));

            Mail::to($pemail)->send(new CambiodeEstadoSolicitud($estado, $projectname));
            Mail::to($uemail)->send(new CambiodeEstadoSolicitud($estado, $projectname));

            return redirect()->route('editCompanyProject', ['id' => $project])->with('error', 'Solicitud Declinada');
        }
    }



    /**
     * @param $id
     * @return mixed
     */
    public function changestudentPerformanceCompany($id)
    {
        $student = Participante::where('person_profile_id', $id)->first();
        $status = DB::select('select * from status where id = 13 or id = 14 or id=15');

        return view('project.changestudentPerformanceCompany', [
            "student" => $student,
            "status" => $status
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function setgradeParticipante(Request $request, $id)
    {
        $project = DB::table('participantes')->where('person_profile_id', $id)->value('participant_project_id');
        if (ParticipanteBL::setgrade($request->all(), $id))
            return redirect()->route('editCompanyProject', ['id' => $project])->with('sucess', 'Datos guardados correctamente.');

        return redirect('editCompanyProject', ['id' => $project])->with('error', 'Los datos no pudieron ser guardados.');
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function setperformanceParticipante(Request $request, $id)
    {
        $project = DB::table('participantes')->where('person_profile_id', $id)->value('participant_project_id');

        if (ParticipanteBL::setPerformance($request->all(), $id)) {
            $status = DB::table('participantes')->where('person_profile_id', $id)->value('status_id');

            if ($status == 14 or $status == 15)
                return redirect()->route('reportstudentperformance', ['id' => $id]);
            else
                return redirect()->route('editCompanyProject', ['id' => $project])->with('sucess', 'Datos guardados correctamente.');

        }
        return redirect('editCompanyProject', ['id' => $project])->with('error', 'Los datos no pudieron ser guardados.');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function reportStudentPerformance($id)
    {
        $status = DB::table('participantes')->where('person_profile_id', $id)->value('status_id');
        $studentname = DB::table('person_profiles')->where('id', $id)->value('first_name');
        $studentlastname = DB::table('person_profiles')->where('id', $id)->value('last_name1');
        $studentseclastname = DB::table('person_profiles')->where('id', $id)->value('last_name2');
        $project = DB::table('participantes')->where('person_profile_id', $id)->value('participant_project_id');
        $statusname = DB::table('status')->where('id', $status)->value('name');
        $name = $studentname . ' ' . $studentlastname . ' ' . $studentseclastname;
        $projectcompany = DB::table('projects')->where('id', $project)->value('company_id');
        $companyname = DB::table('companies')->where('id', $projectcompany)->value('name');
        $projectname = DB::table('projects')->where('id', $project)->value('title');
        $searchResult = DB::table('admins')->pluck('email');

        Mail::to(env('MAIL_USERNAME'))->send(new ReportStudentPerformance($name, $statusname, $projectname, $companyname));

        return redirect()->route('editCompanyProject', ['id' => $project])->with('sucess', 'Datos guardados correctamente.');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function showCompanyProjectStudents($id)
    {
        $project = Project::find($id);
        $company = Company::where('id', $project->company_id)->first();
        $companyTypes = CompanyType::all();
        $projectTypes = ProjectType::all();
        $processTypes = ProcessType::All();
        $modalities = Modality::All();
        $participante = Participante::where('participant_project_id', $project->id)->get();
        return view('project.showstudentProjectCompany', [
            "companyTypes" => $companyTypes,
            "company" => $company,
            "projectTypes" => $projectTypes,
            "project" => $project,
            "processTypes" => $processTypes,
            "participante" => $participante,
            "modalities" => $modalities
        ]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function assignParticipantTutor($id)
    {
        $participante = Participante::find($id);
        $tutor = Tutor::all();
        return view('tutors.AssignTutorParticipant', [
            "participante" => $participante,
            "tutors" => $tutor
        ]);
    }

}


