<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectDefense;
use App\Models\AcademicRepresentative;
use App\Models\Tutor;
use App\Models\Period;
use App\Models\Student;
use App\Http\Requests\CreateDefenseRequest;
use App\BL\ProjectDefenseBL;
use App\Http\Requests\EditProjectDefense;

class ProjectDefenseController extends Controller
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
        $defenses = ProjectDefense::all();

        return view('projectdefense.index', [
            'defenses' => $defenses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $period = Period::where('active', true)->first();
        $studentsQuery = Student::where('period_id', '=', $period->id);
        $studentsQuery->where(function($query) {
            $query->where('pes_registered', '=', true)
            ->orWhere('tfg_registered', '=', true);
        });
        $studentsList = $studentsQuery->get();
        $query = AcademicRepresentative::where('deleted', '=', false);
        $academicRep = $query->get();
        $tutors = Tutor::all();

        return view('projectdefense.create', [
            'studentsList' => $studentsList,
            'academicRep' => $academicRep,
            'readers' => $tutors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDefenseRequest $request)
    {
        $result = ProjectDefenseBL::createDefense($request->all());
        if (!$result) {
            $request->flash();
            return redirect()->route('createDefense')->with('error', 'No se pudo crear la defensa.');
        }

        return redirect()->route('defensesList')->with('sucess', 'Defensa creada.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $defense = ProjectDefense::find($id);
        $query = AcademicRepresentative::where('deleted', '=', false);
        $academicRep = $query->get();
        $tutors = Tutor::all();

        return view('projectdefense.edit', [
            'defense' => $defense,
            'academicRep' => $academicRep,
            'readers' => $tutors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProjectDefense $request)
    {
        $result = ProjectDefenseBL::editDefense($request->all());

        if (!$result) {
            $request->flash();
            return redirect()->route('createDefense')->with('error', 'No se pudo editar la defensa.');
        }

        return redirect()->route('defensesList')->with('sucess', 'Defensa editada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $defense = ProjectDefense::find($id);
            $defense->delete();

            return redirect()->route('defensesList')->with('sucess', 'Defensa eliminada.');
        }
        catch (\Exception $ex)
		{
			return redirect()->route('defensesList')->with('error', 'La defensa no pudo ser eliminada.');
		}
    }
}
