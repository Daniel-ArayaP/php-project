<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfesorRequest;
use App\Models\Profesor;
use App\Http\Requests\CreateProfesorRequest;


class ProfesorController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
       $profesor = Profesor::all();
        return view('profesor/index', ['profesor' => $profesor]);
    }

    public function create()
    {
        return view("profesor.create");
    }

    public function store(CreateProfesorRequest $request)
    {
        $profesor=new Profesor;
        $profesor->cedula_profesores= request()->cedula_profesores;
        $profesor->nombre_profesores= request()->nombre_profesores;
        $profesor->apellido1_profesores= request()->apellido1_profesores;
        $profesor->apellido2_profesores= request()->apellido2_profesores;
        $profesor->save();
        return Redirect('profesor/create')->with('success', 'Los datos del profesor se han guardado correctamente');
    }

    //retorna la pantalla editar
    public function edit(Profesor $profesor)
    {
        return view("profesor.edit", compact('profesor'));
    }

    //funcion para actualizar los datos de profesor
    public function update(Profesor $profesor, ProfesorRequest $request)
    {
        $profesor->cedula_profesores= request()->cedula_profesores;
        $profesor->nombre_profesores= request()->nombre_profesores;
        $profesor->apellido1_profesores= request()->apellido1_profesores;
        $profesor->apellido2_profesores= request()->apellido2_profesores;
        $profesor->save();
        \Session::flash('flash_message', 'Datos actualizados correctamente');
        return Redirect('profesor');
    }

    //funcion para eliminar profesores
    public function destroy(Profesor $profesor)
    {
        $profesor->delete();
        return Redirect('profesor');

    }
}
