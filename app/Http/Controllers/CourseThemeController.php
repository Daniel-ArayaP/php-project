<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProjectOpportunity;
use App\Models\Period;
use App\Models\Sede;
use App\Models\Course;
use App\BL\CourseBL;
use App\Http\Requests\ProjectOportunity;
use App\Http\Requests\CreateCourseRequest;

class CourseThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function theme($idCourse,$idTheme)
    {
        $courses=DB::table("cursos")->where('id_cursos',$idCourse)->first();
        $sedes=Sede::all();
        $cursos = DB::table("cursos")->get();
        $estados = DB::table("status")->get();
        $temas = DB::table("temas_cursos")->get();

        $schedules = DB::table("schedule")->where('cursos_id_cursos', '=', $idCourse)->get();
        $countSize=count($schedules);

        $temas = DB::table("temas_cursos")->get();
        $specificTheme = DB::table("temas_cursos")->where('cursos_id_cursos',$idCourse)->get();

        $specificCourseTheme = DB::table("temas_cursos")
                ->where('cursos_id_cursos', '=', $idCourse)
                ->where('id_temas_cursos', '=', $idTheme)
                ->first();

        return view('course.todos.editTheme', compact('courses', 'sedes','cursos','estados','countSize','schedules','specificTheme','temas','idCourse','specificCourseTheme'));
    }

    public function updateTheme(Request $request)
    {

        if (CourseBL::updateTheme($request->all())) {
            return redirect('courses/todos/create')->with('sucess', 'Tema creado correctamente.');
        } else {
            return redirect()->route('createCourses')->with('error', 'El tema no se pudo crear.');
        }
    }
}
