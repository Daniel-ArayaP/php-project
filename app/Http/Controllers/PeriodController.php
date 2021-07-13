<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Period;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BL\PeriodBL;
use Illuminate\Support\Facades\Auth;
use App\Enums\SaveResult;
use App\Http\Requests\CreatePeriodRequest;

class PeriodController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $periods = Period::all();

        return view('Period.index', [
            'period' => $periods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Period.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePeriodRequest $request)
    {

        if (!$request->has('id')) {
            $admin = Admin::where('user_id', Auth::user()->id)->first();
            $result = PeriodBL::createPeriod($request->all(), $admin->user_id, $request->has('active'));
        }
        else {
            $result = PeriodBL::editPeriod($request->all(), $request->has('active'));
        }

        switch ($result) {
            case SaveResult::SUCCESS:
                return redirect()->route('periods')->with('sucess', 'Periodo guardado correctamente.');
            case SaveResult::DATES_ERROR:
                return redirect()->route('createPeriod')->with('error', 'La fecha de finalización debe ser mayor a la fecha de inicio.');
            case SaveResult::INTERNAL_ERROR:
                return redirect()->route('periods')->with('error', 'El periodo no pudo ser guardado.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $period = Period::find($id);

        return view('Period.create',[
            'period' => $period
        ]);
    }
}

