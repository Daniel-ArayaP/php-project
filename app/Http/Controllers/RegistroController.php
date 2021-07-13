<?php

namespace App\Http\Controllers;

use App\Models\Convalidacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Registro;
use Illuminate\Support\Facades\DB;
use App\Models\CarreraUlatina;
use Iluminate\Support\Facades\Input;
use App\Models\ContenidoCarrera;
use App\Http\Requests\CreateRegistroRequest;

class RegistroController extends Controller
{
    //

    public function index()
    {
        //$carreraU = Registro::all();
        $carreraU = DB::table('ulatina_carreras')->get();
        $contenidoC1 = DB::table('contenido_carreras')->where('ulatina_carreras_id_carreras_ulatina', '=', 'SIS-001')->get();
        $contenidoC2 = DB::table('contenido_carreras')->where('ulatina_carreras_id_carreras_ulatina', '=', 'SOF-002')->get();
        $contenidoC3 = DB::table('contenido_carreras')->where('ulatina_carreras_id_carreras_ulatina', '=', 'TEL-003')->get();

        $universidad = DB::table('universidades')->get();
        $contenidoU = DB::table('contenido_universidades')->get();

        return view('Registro/index', compact('carreraU', 'contenidoC1', 'contenidoC2', 'contenidoC3', 'universidad', 'contenidoU'));
    }

    public function show(Request $request)
    {

        $registro = Registro::query()
            ->where('registros.id_carreras_ulatina_registros', '=', $request->carrerasUlatina)
            ->orWhere('id_universidades_registros', '=', $request->codigoUniversidad)->paginate(10);

        //    $registro = DB::table('registros')->where('id_carreras_ulatina_registros','=', $carreras)->where('id_universidades_registros','=', $universidades)->get();
        if ($registro->isEmpty())
            return back()->with('error', 'No existe ningún registro con estos datos');

        $carreraUlatina = DB::table('ulatina_carreras')->get();
        $universidadCarrera = DB::table('universidades')->get();

        return view('Registro/ver', compact('registro', 'carreraUlatina', 'universidadCarrera'));

    }

    public function verRegistros()
    {
        $registro = DB::table('registros')->paginate(10);
        $carreraUlatina = DB::table('ulatina_carreras')->get();
        $universidadCarrera = DB::table('universidades')->get();
        return view('Registro/ver', compact('registro', 'carreraUlatina', 'universidadCarrera'));
    }

    public function store(CreateRegistroRequest $request)
    {

        $registros = new Registro();
        $registros->contenido_carreras_id_contenido_carreras = request()->codigoMateria;
        $registros->id_carreras_ulatina_registros = request()->carrerasUlatina;
        $registros->contenido_universidades_id_contenido_universidades = request()->contenidoUniversidad;
        $registros->id_universidades_registros = request()->universidad;

        $registros->save();

        $convalidacion = new Convalidacion();
        $convalidacion->periodo_convalidaciones = 18;
        $convalidacion->id_carreras_ulatina_convalidaciones = "SIS-001";
        $convalidacion->id_universidades_convalidaciones = 1234;
        $convalidacion->students_person_profile_id = 14;
        $convalidacion->save();


        return back()->with('sucess', 'Datos guardados correctamente.');
    }

    public function showMateria($id)
    {
        $registro = DB::table('registros')->where('id_registros', '=', $id)->get();
        $materias = $registro[0]->contenido_carreras_id_contenido_carreras;
        $materias1 = DB::table('contenido_carreras')->where('id_contenido_carreras', '=', $materias)->get();
        $carrera = $registro[0]->id_carreras_ulatina_registros;
        $carrera1 = DB::table('ulatina_carreras')->where('id_carreras_ulatina', '=', $carrera)->get();
        $contenido = $registro[0]->contenido_universidades_id_contenido_universidades;
        $contenido1 = DB::table('contenido_universidades')->where('id_contenido_universidades', '=', $contenido)->get();
        $universidad = $registro[0]->id_universidades_registros;
        $universidad1 = DB::table('universidades')->where('id_universidades', '=', $universidad)->get();

        return view('Registro/descripcion', compact('registro', 'materias1', 'carrera1', 'contenido1', 'universidad1'));
    }

    public function myformAjax($id)
    {
        $contenidoU = DB::table("contenido_universidades")
            ->where("universidades_id_universidaddes", $id)
            ->get();
        return json_encode($contenidoU);
    }
}

