<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Encuesta;
use App\Models\Profesor;
use App\Models\Curso;
use App\Http\Requests\CreateEncuestaRequest;

class EncuestaController extends Controller
{
    public function __contruct()
    {
        
    }
    //pantalla index de evaluaciones
    public function index(Request $request)
    {
        $encuesta=Encuesta::all();
        return view('encuesta/index', ['encuesta' => $encuesta]);
    }
    public function create()
    {
        $profesor=Profesor::all();
        $curso=Curso::all();
        return view("encuesta.create", ['profesor' => $profesor], ['curso'=>$curso]);
    }
    //funcion para almacenar datos
    public function store(CreateEncuestaRequest $request)
    {
        $encuesta=new Encuesta;
        $encuesta->titulo_encuestas= request()->titulo_encuestas;
        $encuesta->periodo_encuestas= request()->periodo_encuestas;
        $encuesta->cursos_id_cursos= request()->cursos_id_cursos;
        $encuesta->profesores_id_profesores=request()->profesores_id_profesores;
        $encuesta->pregunta1_encuestas=request()->pregunta_1;
        $encuesta->pregunta2_encuestas=request()->pregunta_2;
        $encuesta->pregunta3_encuestas=request()->pregunta_3;
        $encuesta->pregunta4_encuestas=request()->pregunta_4;
        $encuesta->pregunta5_encuestas=request()->pregunta_5;
        $encuesta->pregunta6_encuestas=request()->pregunta_6;
        $encuesta->pregunta7_encuestas=request()->pregunta_7;
        $encuesta->pregunta8_encuestas=request()->pregunta_8;
        $encuesta->pregunta9_encuestas=request()->pregunta_9;
        $encuesta->save();
        return Redirect('encuesta/create')->with('success', 'Los datos de la evaluaci&oacute;n se han guardado correctamente');
    }
   
    //llama a pantalla editar
    public function edit(Encuesta $encuesta)
    {
        $profesor=Profesor::all();
        $curso=Curso::all();
        return view('encuesta.edit',['encuesta' =>$encuesta, 'curso' => $curso, 'profesor' => $profesor]);
    }

    //funcion para actualizar datos 
    public function update(Encuesta $encuesta, CreateEncuestaRequest $request)
    {
        $encuesta->titulo_encuestas= request()->titulo_encuestas;
        $encuesta->periodo_encuestas= request()->periodo_encuestas;
        $encuesta->cursos_id_cursos= request()->cursos_id_cursos;
        $encuesta->profesores_id_profesores=request()->profesores_id_profesores;
        $encuesta->pregunta1_encuestas=request()->pregunta_1;
        $encuesta->pregunta2_encuestas=request()->pregunta_2;
        $encuesta->pregunta3_encuestas=request()->pregunta_3;
        $encuesta->pregunta4_encuestas=request()->pregunta_4;
        $encuesta->pregunta5_encuestas=request()->pregunta_5;
        $encuesta->pregunta6_encuestas=request()->pregunta_6;
        $encuesta->pregunta7_encuestas=request()->pregunta_7;
        $encuesta->pregunta8_encuestas=request()->pregunta_8;
        $encuesta->pregunta9_encuestas=request()->pregunta_9;
        $encuesta->save();
        \Session::flash('flash_message', 'Datos actualizados correctamente');
        return Redirect('encuesta');
    }

    //funcion para eliminar evaluaciones
    public function destroy(Encuesta $encuesta)
    {
        $encuesta->delete();
        return Redirect('encuesta')->with('error', 'Los datos de la evaluaci&oacute;n se han eliminado');

    }
}
