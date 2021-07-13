<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\BL\TutorBL;
use App\Http\Requests\CreateTutorRequest;
use App\Enums\SaveResult;
use App\BL\StudentBL;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\Period;
use App\BL\ParticipanteBL;
use App\Models\Participante;
use DB;
use Mail;
use App\Mail\notificationTutorAssigned;
use App\Mail\notificationStudentTutorass;

class TutorController extends Controller
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
    public function index(Request $request)
    {
        $tutors;

        if (count($request->all()) <= 1) {
            $tutors = Tutor::all();
        }
        else {
            $result = TutorBL::searchTutor($request->all());
            $tutors = $result->paginate(5);
             
            if($tutors->items() == null){
                return redirect()->route('tutors')->with('error', 'El nombre indicado no existe');
            }
            else{
            $tutors->appends([
                'name' => ($request->name == null?'':$request->name)]);
                
            }
            $request->flash();
        }

        return view('tutors.index',[
            'tutors' => $tutors
        ]);
    }

    public function addstudentCompanyproject(Request $request)
    {
        $data = $request->all();
        $tutor = Tutor::find($data['tutor']);
        $period = Period::where('active', true)->first(); 
        $search=DB::table('student_tutor')->where('student_person_profile_id',$data['userId'])->value('student_person_profile_id');
        if($search==$data['userId']){
            return redirect()->route('assignParticipantTutor',['id'=>$data['userId']])->with('error', 'El estudiante ya tiene un tutor asignado.');
        }
        else{
            $tutor->students()->attach($data['userId'], ['period_id' => $period->id]); 
            $result=ParticipanteBL::addTutor($data['tutor'],$data['userId']);
            if (!$result) {
                return redirect()->route('assignParticipantTutor',['id'=>$data['userId']])->with('error', 'El tutor no pudo ser asignado.');
            }
            return redirect()->route('tutornotification',['id'=>$data['userId']]);
        }
    }

    public function notificationTutor($id)
    {
        $searchtutor=DB::table('participantes')->where('person_profile_id',$id)->value('tutor_person_profile_id');
        $tutor = Tutor::find($searchtutor);
        $student=Student::find($id);
        $participante=Participante::find($id);
        Mail::to($student['personal_email'])->send(new notificationTutorAssigned($tutor->getFullNameAttribute(),$tutor->profile['phone'],$tutor['email']));
        Mail::to($student['university_email'])->send(new notificationTutorAssigned($tutor->getFullNameAttribute(),$tutor->profile['phone'],$tutor['email']));
        Mail::to($tutor['email'])->send(new notificationStudentTutorass($student->getFullNameAttribute(),$participante->projects['title']));
   
        return redirect()->route('editCompanyProjectAdmin',['id'=>$participante->participant_project_id])->with('sucess', 'Tutor asignado correctamente.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTutorRequest $request)
    {
        $result;

        if (!$request->has('id')) {
            $result = TutorBL::createTutor($request->all());
        }
        else {
            $result = TutorBL::editTutor($request->all());
        }
        

        switch ($result) {
            case SaveResult::SUCCESS:
                return redirect()->route('tutors')->with('sucess', 'Tutor guardado correctamente.');
            case SaveResult::INTERNAL_ERROR:
                return redirect()->route('createTutor')->with('error', 'El tutor no pudo ser guardado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $period = Period::where('active', true)->first();
        
        $tutor = Tutor::find($id);
        $students = $tutor->students()->where('student_tutor.period_id', '=', $period->id)->get();
        $studentsIds = $students->map(function ($student) {
            return $student->person_profile_id;
        });

        $studentsQuery = Student::where(function($query) {
            $query->where('pes_registered', '=', true)
            ->orWhere('tcu_registered', '=', true)
            ->orWhere('tfg_registered', '=', true);
        });
        
        

        $studentsList = $studentsQuery->whereNotIn('person_profile_id', $studentsIds->toArray())->get();

        return view('tutors.details',[
            'tutor' => $tutor,
            'students' => $students,
            'studentsList' => $studentsList,
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutor = Tutor::find($id);

        return view('tutors.create',[
            'tutor' => $tutor
        ]);
    }

    public function addStudent(Request $request)
    {
        try
        {
            $data = $request->all();
            $tutor = Tutor::find($data['id']);

            if ($data['student'] == null) {
                return redirect()->route('showTutor', ['id' => $tutor])->with('error', 'Debe seleccionar un estudiante.');
            }

            $period = Period::where('active', true)->first();

            $tutor->students()->attach($data['student'], ['period_id' => $period->id]);

            return redirect()->route('showTutor', ['id' => $tutor])->with('sucess', 'Estudiante agregado correctamente.');
        }
        catch (\Exception $ex)
        {
            return redirect()->route('showTutor', ['id' => $tutor])->with('error', 'El estudiante no pudo ser agregado.');
        }
    }

    public function removeStudent($tutor, $student)
    {
        try
        {
            $tutor = Tutor::find($tutor);
            $period = Period::where('active', true)->first();

            $tutor->students()->detach($student, ['period_id' => $period->id]);

            return redirect()->route('showTutor', ['id' => $tutor])->with('sucess', 'Estudiante removido correctamente.');
        }
        catch (\Exception $ex)
        {
            return redirect()->route('showTutor', ['id' => $tutor])->with('error', 'El estudiante no pudo ser removido.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = TutorBL::deleteTutor($id);

        if (!$result) {
            return redirect()->route('tutors')->with('error', 'El tutor no pudo ser eliminado.');
        }

        return redirect()->route('tutors')->with('sucess', 'Tutor eliminado correctamente.');
    }

}