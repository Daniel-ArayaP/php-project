<?php

namespace App\Http\Controllers;

use App\Models\AcademicRepresentative;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BL\AcademicRepBL;
use App\Http\Requests\CreateRepAcademicRequest;
use App\Enums\SaveResult;

class AcademicRepController extends Controller
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

        $acRep = AcademicRepresentative::all();
 
        return view('academicrep.index',[
            'acRep' => $acRep
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academicrep.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRepAcademicRequest $request)
    {
        //dd(request()->all());
        $result;

        if (!$request->has('id')) {
            $result = AcademicRepBL::createAcademicRep($request->all()) ;
            
        }
        else {
            $result = AcademicRepBL::editAcademicRep($request->all());
        }
        

        switch ($result) {
            case SaveResult::SUCCESS:
                return redirect()->route('acadRepresentatives')->with('sucess', 'Representante académico guardado correctamente.');
            case SaveResult::INTERNAL_ERROR:
                return redirect()->route('acadRepCreate')->with('error', 'El Representante académico no pudo ser guardado.');
            case SaveResult::EXISTING_DATA:
                return redirect()->route('acadRepCreate')->with('error', 'El Representante académico ya existe.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicRepresentative  $academicRepresentative
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acadRep = AcademicRepresentative::find($id);

        return view('academicrep.create',[
            'acadRep' => $acadRep
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicRepresentative  $academicRepresentative
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = AcademicRepBL::deleteRep($id);

        if (!$result) {
            return redirect()->route('acadRepresentatives')->with('error', 'El representante académico no pudo ser eliminado.');
        }

        return redirect()->route('acadRepresentatives')->with('sucess', 'Representante académico eliminado correctamente.');
    }
}
