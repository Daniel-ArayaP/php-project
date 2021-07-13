<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use App\BL\EmpresaBL;
use App\Enums\SaveResult;

class EmpresaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('empresa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('empresa.saludo');
    }

    public function profile()
    {
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();

        return view('empresa.profile', [
            'empresa' => $empresa,
        ]);
    }

}
