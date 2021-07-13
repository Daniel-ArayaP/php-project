<?php

namespace App\Http\Controllers;

use App\Models\Convalidacion;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnalisisController extends Controller
{
    //
    public function index()
    {
        /*$convalidacion = DB::table('convalidaciones')->get();
        foreach ($convalidacion as $convalidacion1) {
            $cedula1 = $convalidacion1->students_person_profile_id;
            $periodo1 = $convalidacion1->periodo_convalidaciones;
            $cedula = DB::table('students')->where('person_profile_id', '=', $cedula1)->get();
            $periodo = DB::table('periods')->where('id', '=', $periodo1)->get();
        }*/

        $convalidacion = Convalidacion::query()->join('students as A', 'convalidaciones.students_person_profile_id', '=', 'A.person_profile_id')
            ->join('periods as B', 'convalidaciones.periodo_convalidaciones', '=', 'B.id')
            ->paginate(10);

        //return view('Analisis/estudiante', compact('convalidacion', 'cedula', 'periodo'));
        return view('Analisis/estudiante', compact('convalidacion'));
    }

    public function showEstudiantes(Request $request)
    {

        if ($cedula2 = Student::query()->where('id_document', '=', $request->cedula)->get()) {

            $convalidacion = Convalidacion::query()->join('students as A', 'convalidaciones.students_person_profile_id', '=', 'A.person_profile_id')
                ->join('periods as B', 'convalidaciones.periodo_convalidaciones', '=', 'B.id')
                ->where('A.id_document', '=', $request->cedula)
                ->paginate(10);

            return view('Analisis/estudiante', compact('convalidacion'));

        } else {
            return back()->with('error', 'El estudiante ingresado no está registrado en la base de datos');
        }

    }

    public function reportCarrera()
    {
        $carreras = DB::table('ulatina_carreras')->get();
        $convalidacion = DB::table('convalidaciones')->paginate(10);

        return view('Analisis/carrera', compact('carreras', 'convalidacion'));
    }

    public function showCarrera(Request $request)
    {
        $carrera = request()->carreraUlatina;
        $carreras = DB::table('ulatina_carreras')->get();
        $convalidacion = DB::table('convalidaciones')->where('id_carreras_ulatina_convalidaciones', '=', $carrera)->paginate(10);

        return view('Analisis/carrera', compact('convalidacion', 'carreras'));
    }

    public function reportPeriodo()
    {
        $periodo = DB::table('periods')->get();
        $convalidacion = DB::table('convalidaciones')->paginate(5);

        return view('Analisis/periodo', compact('periodo', 'convalidacion'));
    }

    public function showPeriodo(Request $request)
    {
        $periodos = request()->periodo;
        $periodo = DB::table('periods')->get();
        $convalidacion = DB::table('convalidaciones')->where('periodo_convalidaciones', '=', $periodos)->paginate(5);

        return view('Analisis/periodo', compact('periodo', 'convalidacion'));

    }

    public function reportInstituto()
    {
        $universidad = DB::table('universidades')->get();
        $convalidacion = DB::table('convalidaciones')->paginate(10);

        return view('Analisis/instituto', compact('universidad', 'convalidacion'));
    }

    public function showInstituto(Request $request)
    {
        $universidad1 = request()->universidad;
        $convalidacion = DB::table('convalidaciones')->where('id_universidades_convalidaciones', '=', $universidad1)->paginate(10);
        $universidad = DB::table('universidades')->get();

        return view('Analisis/instituto', compact('universidad', 'convalidacion'));
    }
}

