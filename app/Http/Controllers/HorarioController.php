<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Horario;
use App\Models\Profesor;
use DB;


class HorarioController extends Controller
{
    public function __contruct()
    {
        
    }
    //pantalla con lista de horarios
    public function index()
    {
        $profesores = DB::table('profesores')->select('id_profesores', 'nombre_profesores', 'apellido1_profesores', 'apellido2_profesores')->get();

        $matrix = [];

        foreach($profesores as $nom) {
            
            $horario = DB::table('admin_horarios')->select()->where('profesores_id_profesores','=',$nom->id_profesores)->get();
            $horario->{"nombre"} = $nom->nombre_profesores . " ". $nom->apellido1_profesores . " " . $nom->apellido2_profesores;
            array_push($matrix, $horario);
            
        }
        return view('horario/index', ["horario" => $matrix]);
    }
    //retorn pantalla crear horarios
    public function create()
    {
        $profesor = Profesor::all();
        return view("horario.create", ['profesor' => $profesor]);
    }
    //guardar horarios
    public function store()
    {
        $horario=new Horario;
        $horario->hora_inicio= request()->hora_inicio;
        $horario->hora_salida= request()->hora_salida;
        $horario->hora_almuerzo= request()->hora_almuerzo;
        $horario->almuerzo_fin=request()->almuerzo_fin;
        $horario->observacion= request()->observacion;
        $horario->profesores_id_profesores= request()->profesores_id_profesores;
        $horario->save();
        return Redirect('horario/create')->with('success', 'Los datos del horario se han guardado correctamente');
    }
    /*
    public function edit(Horario $horario)
    {
        return view("horario.edit", compact('horario'));
    }
    public function update(Horario $horario)
    {
        $horario->nombre=request()->nombre;
        $horario->hora_inicio=request()->hora_inicio;
        $horario->hora_salida=request()->hora_salida;
        $horario->hora_almuerzo=request()->hora_almuerzo;
        $horario->observacion=request()->observacion;
        $horario->save();
        return Redirect('horario');
    }
    public function destroy(Horario $horario)
    {
        $horario->delete();
        return Redirect('horario');

    }*/
}
