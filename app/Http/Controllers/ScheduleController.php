<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\BL\ScheduleBL;
use Illuminate\Support\Facades\Auth;
use App\Enums\SaveResult;
use App\Http\Requests\CreateScheduleRequest;
use App\Models\Modality;
use App\Models\Period;

class ScheduleController extends Controller
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

        $schedule;
        $period = Period::where('active', true)->first();
        $periods = Period::all();
        $filterPeriod;
                

        if (count($request->all()) >= 1) {
            $schedule = Schedule::where('period_id', '=', $period->id)->paginate(5);
            
            $filterPeriod = $period->id;            
        }
        else if (empty($request->all())) {
            $schedule = Schedule::all();
            $filterPeriod = $period->id;
        }
        else {
            $query = ScheduleBL::searchSchedule($request->all());
            $schedule = $query->paginate(5);
            $schedule->appends([
                
                'period' => $request->period
                ]);
            $request->flash();

            if (isset($request->all()['period'])) {
                $filterPeriod = $request->all()['period'];
            }
            else {
                $filterPeriod = $period->id;
            }
        }
        
        return view('schedules.index', [
            'periods' => $periods,
            'schedules' => $schedule,
            'filterPeriod' => $filterPeriod            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modalities = Modality::All();
        return view('schedules.create',[ 
            "modalities" => $modalities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $result;

        //dd($data);
        if (isset($data['id'])) {
            $result = ScheduleBL::editSchedule($data);
        }
        else {
            $result = ScheduleBL::createSchedule($data);
        }

        if ($result) {
            return redirect()->route('schedules')->with('sucess', 'Horario de TCU guardada con exito.');
        }

        return redirect()->route('schedules')->with('error', 'El horario no puedo ser guardado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $period
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedules = Schedule::find($id);
        $modalities = Modality::All();

        return view('schedules.create',[
            "modalities" => $modalities,
            'schedule' => $schedules
        ]);
    }

    public function show($id)
    {
        $schedules = Schedule::find($id);

        return view('schedules.show', [
            'schedules' => $schedules
        ]);
    }

    public function destroy($id)
    {
        try
        {
            $schedules = Schedule::find($id);
            $schedules->delete();

            return redirect()->route('schedules')->with('sucess', 'Oportunidad de proyecto eliminada.');
        }
        catch(\Exeption $ex)
		{
            return redirect()->route('schedules')->with('error', 'La oportunidad de proyecto no pudo ser eliminada.');
		}
    }
}
