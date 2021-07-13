<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BL\ReportsBL;
use App\Models\ProcessType;
use App\Models\Period;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\BL\ExportBL;
use DB;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use App\Models\Participante;
use App\BL\ParticipanteBL;
use App\Exports\ApprovedStudents;



class ReportsController extends Controller
{


    /**
     * Create a new controller instance.
     *p
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function studentsReport(Request $request)
    {
        $activePeriod = Period::where('active', true)->first();
        $process = ProcessType::all();
        $periods = Period::all();
        $data = $request->all();


        if (isset($data['period'])) {
            $periodId = $data['period'];
        }
        else {
            $periodId = $activePeriod->id;
        }

        $request->flash();
        $result = ReportsBL::studentsReport($data);

        $projects = $result->paginate(5);

        return view('reports.studentsreport',['process' => $process,
            'periods' => $periods,
            'projects' => $projects,
            'periodId' => $periodId
        ]);
     }



    public function companiesReport(Request $request)
    {
        $activePeriod = Period::where('active', true)->first();
        $process = ProcessType::all();
        $periods = Period::all();
        $data = $request->all();



        if (isset($data['period'])) {
            $periodId = $data['period'];
        }
        else {
            $periodId = $activePeriod->id;
        }

        $request->flash();
        $result = ReportsBL::companiesReport($data);

        //$projects = $result->get();
        $projects = $result->get();

        return view('reports.companiesreport',[
            'process' => $process,
            'periods' => $periods,
            'projects' => $projects,
            'periodId' => $periodId
        ]);
    }


    public function companiesReportStudents(Request $request)
    {
        $activePeriod = Period::where('active', true)->first();
        $process = ProcessType::where('name', '!=', 'TCU')->get();
        $periods = Period::all();
        $data = $request->all();
//        $periodId;

        if (isset($data['period'])) {
            $periodId = $data['period'];
        }
        else {
            $periodId = $activePeriod->id;
        }

        $request->flash();
        $result = ReportsBL::companiesReportStudents($data);

        $projects = $result->paginate(10);

        return view('reports.companiesreportstudents',[
            'process' => $process,
            'periods' => $periods,
            'projects' => $projects,
            'periodId' => $periodId
        ]);
    }

    public function export()
    {
        return Excel::download(new ExportBL, 'students.xlsx');
    }

    public function solicitudeReportStudents(){
        $student = DB::select('select * from students where university_email = :email', ['email' => Auth::user()->email]);
        $id=$student[0]->person_profile_id;
        $countsol=DB::table('solicitudes')->where('person_profile_id',$id)->count();
       $result=ReportsBL::solicitudReportStudents($id)->get();

        return view('reports.solicitudesreportstudents',[
            'solicitud'=> $result,
            'solicitudes'=>$countsol
        ]);
    }

    public function projectinReportStudents(){
        $student = DB::select('select * from students where university_email = university_email', ['email' => Auth::user()->email]);
         //var_dump($student[4]);
        $id=$student[0]->person_profile_id;
        //$id=$student['4']->person_profile_id;
        $project= DB::table('participantes')->where('person_profile_id',$id)->value('participant_project_id');
        $studentquantity=DB::table('projects')->where('id',$project)->value('students_quantity');
        $participantquantity=DB::table('participantes')->where('participant_project_id',$project)->count();
        $result=ReportsBL::participanteReportStudents($id)->get();


        return view('reports.projectReportstudents',[
            'participante'=> $result,
            'participantes'=>$participantquantity,
            'students'=>$studentquantity

        ]);
    }

    public function ApprovedStudentsReport(Request $request){
        $activePeriod = Period::where('active', true)->first();
        $periods = Period::all();
        $data = $request->all();
        $periodId;

        if (isset($data['period']))
        {
            $periodId = $data['period'];
        }
        else {
            $periodId = $activePeriod->id;
        }

        $request->flash();
        $result = ReportsBL::ApprovedStudentsReport($data);

        $participantes = $result->paginate(5);

        return view('reports.ApprovedParticipantsReport',[
            'periods' => $periods,
            'participante' => $participantes,
            'periodId' => $periodId
        ]);
    }
    public function generateReport(){

        return Excel::download(new ApprovedStudents(), 'Estudiantes Aprobados.xlsx');
    }
    public function proyect_pdf($person_profile_id)
    {

        $project=Student::findOrFail($person_profile_id);
        //$pdf = PDF::loadview('');
        $pdf = \PDF::loadview('reports.imprimirpdf',compact('project'));
        return $pdf->download('Reporte.pdf');
        
    }
}
