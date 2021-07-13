<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Profesor;
use App\Http\Requests\CreateCursoRequest;

class CursoController extends Controller
{
    public function __construct()
    {
        
    }

    //pantalla principal de cursos
    public function index(Request $request)
    {
        $curso = Curso::all();
        return view('curso/index', ['curso' => $curso]);

    }

    //llamar pantalla crear curso
    public function create()
    {
        $profesor = Profesor::all();
        return view("curso.create", ['profesor'=>$profesor]);
    }

    //guarda los datos
    public function store(CreateCursoRequest $request)
    {
        $curso=new Curso;
        $curso->codigo_cursos= request()->codigo_cursos;
        $curso->nombre_cursos= request()->nombre_cursos;
        $curso->grupo_cursos= request()->grupo_cursos;
        $curso->profesores_id_profesores= request()->profesores_id_profesores;
        $curso->save();
        return Redirect('curso/create')->with('success', 'Los datos del curso se han guardado correctamente');
    }
    
    //llamar pantalla editar curso
    public function edit(Curso $curso)
    {
        $profesor = Profesor::all();
        //return view("curso.edit", compact('curso'));
        return view('curso.edit',['curso' => $curso, 'profesor' => $profesor]);
    }

    //modificar cursos
    public function update(Curso $curso, CreateCursoRequest $request)
    {
        $curso->codigo_cursos= request()->codigo_cursos;
        $curso->nombre_cursos= request()->nombre_cursos;
        $curso->grupo_cursos= request()->grupo_cursos;
        $curso->profesores_id_profesores= request()->profesores_id_profesores;
        $curso->save();
        \Session::flash('flash_message', 'Datos actualizados correctamente');
        return Redirect('curso');
    }

    //eliminar cursos
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return Redirect('curso');
    }
}
