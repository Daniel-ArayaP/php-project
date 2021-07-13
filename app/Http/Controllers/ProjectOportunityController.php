<?php

namespace App\Http\Controllers;

use App\Models\CompanyType;
use App\Models\Modality;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectOpportunity;
use App\Models\Period;
use App\BL\ProjectBL;
use App\Http\Requests\ProjectOportunity;
use App\Models\ProcessType;
use Illuminate\Support\Facades\Auth;

class ProjectOportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunities = ProjectOpportunity::all();

        return view('oportunities.index', [
            'oportunities' => $oportunities,
        ]);
    }

    public function show ($id) {
        $oportunity = ProjectOpportunity::find($id);
        $processTypes = ProcessType::All();

        return view('oportunities.show', [
            'oportunity' => $oportunity,
            "processTypes" => $processTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $processTypes = ProcessType::All();
        $companyTypes = CompanyType::all();
        $projectTypes = ProjectType::all();
        $modalities = Modality::All();

        return view('oportunities.create', [
            "companyTypes" => $companyTypes,
            "projectTypes" => $projectTypes,
            "processTypes" => $processTypes,
            "modalities" => $modalities
        ]);
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
//        dd($data);
        $result;

        if (isset($data['id'])) {
            $result = ProjectBL::editOportunity($data);
        }
        else {
            $result = ProjectBL::createOportunity($data);
        }

        if ($result) {
            if (Auth::user()->role_id == 1)  {
                return redirect()->route('oportunities')->with('sucess', 'Oportunidad de proyecto guardada con exito.');
            } else {
                return redirect()->route('createOportunities')->with('sucess', 'Oportunidad de proyecto guardada con exito.');
            }
        }

        return redirect()->route('oportunities')->with('error', 'La oportunidad de proyecto no pudo guardada.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oportunity = ProjectOpportunity::find($id);

        $processTypes = ProcessType::All();
        $companyTypes = CompanyType::all();
        $projectTypes = ProjectType::all();
        $modalities = Modality::All();

        return view('oportunities.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ProjectBL::deleteOportunity($id);

        if (!$result) {
            return redirect()->route('oportunities')->with('error', 'Oportunidad de proyecto no pudo ser eliminada.');
        }

        return redirect()->route('oportunities')->with('sucess', 'Oportunidad de proyecto eliminada correctamente.');
    }
}
