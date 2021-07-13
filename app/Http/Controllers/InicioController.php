<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    //
    public function index()
    {

        $user = \Auth::user()->role_id;


        $convalidaciones = DB::table('convalidaciones as A')
            ->join('students as B','A.students_person_profile_id','=','B.person_profile_id')
            ->join('periods as C','A.periodo_convalidaciones','=','C.id')
            ->paginate(10);

        //retorna la vista('Inicio/inicio',compact('convalidacion','cedula','periodo', 'user'));
        return view('Inicio/inicio',compact('convalidaciones', 'user'));
    }
}


