<?php

namespace App\BL;
use Illuminate\Support\Facades\DB;

class CourseBL
{
    public static function storeCourse(array $data)
    {
        try
        {
            DB::beginTransaction();

            if(\Auth::user()->role_id == 1)
            {
              $course = \DB::table('cursos')->insertGetId(
                  ['codigo_cursos' => $data['courseCode'],
                   'nombre_cursos' => $data['courseName'],
                   'grupo_cursos' => $data['courseGroup'],
                   'profesores_id_profesores' => $data['courseTeacher'],
                   'solicitado_por' => $data['courseInstitute'],
                   'status_id' => $data['courseStatus'],
                   'sedes_id_sedes' => $data['headquarter'],
                   'comentario_sobre_curso' =>'',
                   'creado_por' => $data['id_user']
                  ]);
            }
            elseif(\Auth::user()->role_id == 4)
            {
              $instituto = \DB::table('institutos')->where('id_user', \Auth::user()->id)->first();
              if(!is_null($instituto))
              {

                $course = \DB::table('cursos')->insertGetId(
                    ['codigo_cursos' => $data['courseCode'],
                     'nombre_cursos' => $data['courseName'],
                     'solicitado_por' => $instituto->id_institutos,
                     'status_id' => $data['courseStatus'],
                     'sedes_id_sedes' => $data['headquarter'],
                     'comentario_sobre_curso' =>'',
                     'creado_por' => $data['id_user']
                    ]);
              }
              else
              {
                return false;
              }
            }
            DB::commit();
            return true;
        }
        catch(\Exeption $ex)
		{
            return false;
		}
    }

    public static function storeSchedule(array $data)
    {

        try
            {
                DB::beginTransaction();

                if(isset($_POST['idValue']))
                {
                  for ($i=0; $i< count($_POST['idValue']); $i++) 
                  {
                    $deleteSchedule = \DB::table("schedule")->where(DB::raw("id"),'=',$data['idValue'][$i])->delete();
                  }

                }
                $curso = \DB::table("cursos")->where(DB::raw("id_cursos"),$_POST['courses1'])->first();

                if(isset($_POST['inicio']))
                {
                  for($i = 0; $i < count($_POST['inicio']) ; $i++)
                  {
                    $schedule = \DB::table("schedule")->where('cursos_id_cursos',$_POST['courses1'])->where('start_day',$_POST['inicio'][$i])->where('finish_day',$_POST['final'][$i])->first();
                    if (is_null($schedule))
                    {
                        $new_schedule = \DB::table('schedule')->insertGetId(
                            ['schedule_date' => $_POST['inicio'][$i],
                            'start_day' => $_POST['inicio'][$i],
                            'finish_day' => $_POST['final'][$i],
                            'cursos_id_cursos' => $curso->id_cursos,
                            'sedes_id_sedes' =>$curso->sedes_id_sedes
                            ]);

                    }
                  }
                }


                DB::commit();
                return true;
            }
            catch(\Exeption $ex)
            {
                return false;
            }
    }

    public static function storeTheme(array $data)
    {
        try
        {
            DB::beginTransaction();

            $idCursos =$data['courses2'];
            $curso = DB::table("cursos")->where("id_cursos",$idCursos)->first();
            $theme = DB::table('temas_cursos')->insertGetId([
                'nombre_temas_cursos' => $data['themeName'],
                 'contenido_temas_curso' => $data['themeContent'],
                 'cursos_id_cursos' => $curso->id_cursos,
                 'sedes_id_sedes' =>$curso->sedes_id_sedes
                ]);

            DB::commit();
            return true;
        }
        catch(\Exeption $ex)
		{
            return false;
		}
    }

    public static function storeInstituteStudentTable(array $data)
    {
        try
        {
            DB::beginTransaction();

            $idCursos =$data['courses3'];
            $curso = \DB::table("cursos")->where(DB::raw("id_cursos"),$data['courses3'])->first();

            if(isset($_POST['idValue']) ){
              for ($i=0; $i< count($_POST['idValue']); $i++) {
                $deleteSchedule = \DB::table("estudiante_institutos")->where(DB::raw("id_estudiantes_institutos"),'=',$data['idValue'][$i])->delete();
              }

            }

            if(isset($_POST['mcedula']) and \Auth::user()->role_id == 1)
            {
              for($i = 0; ($i < intval(count($_POST['mcedula']))); $i++)
              {
                $estudiante =\DB::table('estudiante_institutos')->where('id_cursos', $_POST['courses3'])->where('cedula_estudiantes_institutos', $_POST['mcedula'][$i])->first();
                $modified_student = DB::table("estudiante_institutos")->where(DB::raw("id_estudiantes_institutos"), $estudiante->id_estudiantes_institutos)->update([
                      'status_id' => $_POST['mStatus'][$i]
                ]);
              }
            }

            if(isset($_POST['dcedula']))
            {
              for($i = 0; ($i < intval(count($_POST['dcedula']))); $i++)
              {
                  $estudiante =\DB::table('estudiante_institutos')->where('id_cursos', $_POST['courses3'])->where('cedula_estudiantes_institutos', $_POST['dcedula'][$i])->first();

                  if(is_null($estudiante) )
                  {
                      $tmp_gender = \DB::table("genders")->where(DB::raw("id"),$_POST['dgenero'][$i])->first();
                      $new_student = \DB::table('estudiante_institutos')->insertGetId([
                              'genders_id' => $tmp_gender->id,
                              'genders_name' => $tmp_gender->name,
                              'primer_apellido_estudiantes_institutos' => $_POST['dprimerApellido'][$i],
                              'segundo_apellido_estudiantes_institutos' => $_POST['dsegundoApellido'][$i],
                              'nombre_estudiantes_institutos' => $_POST['dnombre'][$i],
                              'cedula_estudiantes_institutos' => $_POST['dcedula'][$i],
                              'edad_estudiantes_institutos' => $_POST['dedad'][$i],
                              'correo_estudiantes_institutos' => $_POST['dcorreo'][$i],
                              'carta_autorizacion_estudiantes_institutos' => file_get_contents($_FILES['dcartaAutorizacion']['tmp_name'][$i]),
                              'poliza_estudiantes_institutos' => file_get_contents($_FILES['dpoliza']['tmp_name'][$i]),
                              'status_id' => $_POST['dStatus'][$i],
                              'id_cursos' => $_POST['courses3']
                      ]);
                  }
                }
            }
            $estudiantes = \DB::table("estudiante_institutos")->where("id_cursos",$data['courses3'])->get();
            $estudiantes_a_impartir = 0;
            if(!is_null($estudiantes))
            {
              foreach ($estudiantes as $student)
              {
                if($student->status_id == 2)
                {
                  $estudiantes_a_impartir += 1;
                }
              }
            }

            $cursoEdit = \DB::table("cursos")->where('codigo_cursos',  $curso->codigo_cursos)->update(['cantidad_estudiantes_recibir' => $data['sizeRow2'],'cantidad_estudiantes_impartir' => $estudiantes_a_impartir]);

            DB::commit();
            return true;
        }
        catch(\Exeption $ex)
		{
            return false;
		}
    }

    public function updateInstituteStudentTable(array $data)
    {
        try
        {
            DB::beginTransaction();

            DB::commit();
            return true;
        }
        catch(\Exeption $ex)
        {
            return false;
        }
    }


    public static function editCourse(array $data, $id_cursos)
    {
        try
        {
            DB::beginTransaction();


            if(\Auth::user()->role_id == 1)
            {
              $course = DB::table("cursos")->where('id_cursos',  $id_cursos['id'])->update(
        				['nombre_cursos' => $id_cursos['courseName'],
                'grupo_cursos' => $id_cursos['courseGroup'],
                'profesores_id_profesores' => $id_cursos['courseTeacher'],
                'solicitado_por' => $id_cursos['courseInstitute'],
        				 'status_id' => $id_cursos['courseStatus'],
        				 'sedes_id_sedes' => $id_cursos['headquarter']
               ]);



              $updateAllSedeCurso = DB::table('schedule')->where('cursos_id_cursos', '=', $id_cursos['id'])->update(array('sedes_id_sedes' => $id_cursos['headquarter']));
              $updateAllTemaCurso = DB::table('temas_cursos')->where('cursos_id_cursos', '=', $id_cursos['id'])->update(array('sedes_id_sedes' => $id_cursos['headquarter']));
            }
            elseif(\Auth::user()->role_id == 4)
            {
              $instituto = \DB::table('institutos')->where('id_user', \Auth::user()->id)->first();
              if(!is_null($instituto))
              {

                $course = DB::table("cursos")->where('id_cursos',  $id_cursos['id'])->update(
          				['nombre_cursos' => $id_cursos['courseName'],
                  'grupo_cursos' => $id_cursos['courseGroup'],
                  'profesores_id_profesores' => $id_cursos['courseTeacher'],
                  'solicitado_por' => $instituto->id_institutos,
          				 'status_id' => $id_cursos['courseStatus'],
          				 'sedes_id_sedes' => $id_cursos['headquarter']
                 ]);



                $updateAllSedeCurso = DB::table('schedule')->where('cursos_id_cursos', '=', $id_cursos['id'])->update(array('sedes_id_sedes' => $id_cursos['headquarter']));
                $updateAllTemaCurso = DB::table('temas_cursos')->where('cursos_id_cursos', '=', $id_cursos['id'])->update(array('sedes_id_sedes' => $id_cursos['headquarter']));
              }
              else
              {
                return false;
              }
            }
            DB::commit();

            return true;
        }
        catch(\Exeption $ex)
        {
                return false;
        }
    }


    public static function detroySchedule(array $data)
    {

        try
            {
                DB::beginTransaction();

                if(isset($_POST['idValue']) ){


                    $deleteSchedule = \DB::table("schedule")->where(DB::raw("id"),'=',$data['idValue'])->delete();
                   // dd($deleteSchedule);
                }

                DB::commit();
                return true;
            }
            catch(\Exeption $ex)
            {
                return false;
            }
    }

    public static function detroyStudentCountInstitue(array $data)
    {

        try
            {
                DB::beginTransaction();

                if(isset($_POST['idInsValue']) ){


                    $deleteSchedule = \DB::table("schedule")->where(DB::raw("id"),'=',$data['idValue'])->delete();
                   // dd($deleteSchedule);
                   $updateInstituteStudentCount = DB::table("schedule")->where('id_cursos',  $data['id'])->update(
                    [
                     'cantidad_estudiantes_recibir' =>$data['idInsValue']
                    ]);
                }

                DB::commit();
                return true;
            }
            catch(\Exeption $ex)
            {
                return false;
            }
    }



    public static function updateTheme(array $data)
    {
        try
        {
            DB::beginTransaction();
            $curso = \DB::table("cursos")->where(DB::raw("id_cursos"),$data['courses2'])->first();
            $tema = DB::table("temas_cursos")->where('cursos_id_cursos',  $data['courses2'])->update(
				['nombre_temas_cursos' => $data['themeName'],
				 'contenido_temas_curso' => $data['themeContent'],
         'cursos_id_cursos' => $curso->id_cursos,
         'sedes_id_sedes' =>$curso->sedes_id_sedes
                ]);

            DB::commit();

            return true;
        }
        catch(\Exeption $ex)
		{
            return false;
		}
    }

    public static function detroyCourse(array $data,$id_cursos)
    {

        try
            {
                DB::beginTransaction();

                    $deleteCourseSchedule = DB::table("schedule")->where(DB::raw("cursos_id_cursos"),'=',$id_cursos)->delete();
                    $deleteAllTemaCurso = DB::table('temas_cursos')->where(DB::raw("cursos_id_cursos"),'=',$id_cursos)->delete();
                    $deleteAllEstudianteCurso = DB::table('estudiante_institutos')->where("id_cursos", $id_cursos)->delete();
                    $deleteCourse = DB::table("cursos")->where(DB::raw("id_cursos"),'=',$id_cursos)->delete();

                DB::commit();
                return true;
            }
            catch(\Exeption $ex)
            {
                return false;
            }
    }

    public static function destroyCourseTheme(array $data)
    {

        try
            {
                DB::beginTransaction();

               // $idCourse=$data['idCourse'];
                $idTheme=$data['idTheme'];


                    $deleteCourse = DB::table("temas_cursos")->where(DB::raw("id_temas_cursos"),'=',$idTheme)->delete();

                   // dd($deleteSchedule);

                DB::commit();
                return true;
            }
            catch(\Exeption $ex)
            {
                return false;
            }
    }

    public static function storeComments(array $data)
    {
        try
        {
            DB::beginTransaction();
            $course = DB::table("cursos")->where('id_cursos',  $data['courses4'])->update(['comentario_sobre_curso' => $data['courseComments']]);
            DB::commit();
            return true;
        }
        catch(\Exeption $ex)
		{
            return false;
		        }
    }

    public static function searchCourses(array $data)
	  {
        if(\Auth::user()->role_id == 1)
        {
          $searchResult = DB::table("cursos")
          /*->where('creado_por','!=', \Auth::user()->id)*/
          ->where(function ($query) use ($data){
            $query->where('codigo_cursos', 'like', '%' . $data['name'] . '%')
                  ->orWhere('nombre_cursos', 'like', '%' . $data['name'] . '%');
          });
        }
        elseif(\Auth::user()->role_id == 4)
        {
          $searchResult = DB::table("cursos")
          ->where(function ($query){
            $query->where([
              ['creado_por','=', \Auth::user()->id]
            ])
            ->orWhere([
              ['status_id','=', 1],
              ['solicitado_por', '=', null]
            ]);
          })
          ->where(function ($query) use ($data){
            $query->where('codigo_cursos', 'like', '%' . $data['name'] . '%')
                  ->orWhere('nombre_cursos', 'like', '%' . $data['name'] . '%');
          });
        }
        elseif(\Auth::user()->role_id == 2)
        {
          $searchResult = DB::table("cursos")
          ->where([
            ['status_id','=', 13],
            ['profesores_id_profesores', '=', null]
          ])
          ->where(function ($query) use ($data){
            $query->where('codigo_cursos', 'like', '%' . $data['name'] . '%')
                  ->orWhere('nombre_cursos', 'like', '%' . $data['name'] . '%');
          });
        }


        return $searchResult;
    }
    public static function searchCourses_index(array $data)
	  {
        $searchResult = null;
        if(\Auth::user()->role_id == 1)
        {
          $searchResult = DB::table("cursos")
          ->where('creado_por','=', \Auth::user()->id)
          ->where(function ($query) use ($data){
            $query->where('codigo_cursos', 'like', '%' . $data['name'] . '%')
                  ->orWhere('nombre_cursos', 'like', '%' . $data['name'] . '%');
          });
        }
        elseif(\Auth::user()->role_id == 4)
        {
          $instituto = \DB::table("institutos")->where(DB::raw("id_user"),\Auth::user()->id)->first();
          if(!is_null($instituto))
          {
            $searchResult = DB::table("cursos")
            //->where('creado_por','=', \Auth::user()->id)
            ->where(function ($query) use ($instituto){
              $query->where('creado_por','=', \Auth::user()->id)
                    ->orWhere('solicitado_por','=', $instituto->id_institutos);
            })
            ->where(function ($query) use ($data){
              $query->where('codigo_cursos', 'like', '%' . $data['name'] . '%')
                    ->orWhere('nombre_cursos', 'like', '%' . $data['name'] . '%');
            });
          }

        }
        elseif(\Auth::user()->role_id == 2)
        {
          $profesor = \DB::table("profesores")->where(DB::raw("id_user"),\Auth::user()->id)->first();
          if(!is_null($profesor))
          {
            $searchResult = DB::table("cursos")
            ->where('profesores_id_profesores','=', $profesor->id_profesores)
            ->where(function ($query) use ($data){
              $query->where('codigo_cursos', 'like', '%' . $data['name'] . '%')
                    ->orWhere('nombre_cursos', 'like', '%' . $data['name'] . '%');
            });
          }
        }

        return $searchResult;
    }

    public static function request_course($id_curso)
    {
      try
      {
        DB::beginTransaction();
        $instituto = \DB::table("institutos")->where(DB::raw("id_user"),\Auth::user()->id)->first();
        if(!is_null($instituto))
        {
          $course = DB::table("cursos")->where('id_cursos',  $id_curso)->update(['solicitado_por' => $instituto->id_institutos, 'status_id' => "9"]);
        }
        DB::commit();
        return true;
      }
      catch(\Exeption $ex)
      {
        return false;
      }
    }
    public static function remove_request_course($id_curso)
    {
      try
      {
        DB::beginTransaction();
        $instituto = \DB::table("institutos")->where(DB::raw("id_user"),\Auth::user()->id)->first();
        if(!is_null($instituto))
        {
          $course = DB::table("cursos")->where('id_cursos',  $id_curso)->update(['solicitado_por' => null, 'status_id' => "1"]);
        }
        DB::commit();
        return true;
      }
      catch(\Exeption $ex)
      {
        return false;
      }
    }

    public static function course_inscription($id_curso)
    {
      try
      {
        DB::beginTransaction();
        $profesor = \DB::table("profesores")->where(DB::raw("id_user"),\Auth::user()->id)->first();
        if(!is_null($profesor))
        {
          $course = DB::table("cursos")->where('id_cursos',  $id_curso)->update(['profesores_id_profesores' => $profesor->id_profesores, 'status_id' => "11"]);
        }
        DB::commit();
        return true;
      }
      catch(\Exeption $ex)
      {
        return false;
      }
    }
    public static function remove_course_inscription($id_curso)
    {
      try
      {
        DB::beginTransaction();
        $profesor = \DB::table("profesores")->where(DB::raw("id_user"),\Auth::user()->id)->first();
        if(!is_null($profesor))
        {
          $course = DB::table("cursos")->where('id_cursos',  $id_curso)->update(['profesores_id_profesores' => null, 'status_id' => "13"]);
        }
        DB::commit();
        return true;
      }
      catch(\Exeption $ex)
      {
        return false;
      }
    }

    public static function proceso_curso_estudiante()
    {
      try
      {
        DB::beginTransaction();
        $profesor = \DB::table("profesores")->where(DB::raw("id_user"),\Auth::user()->id)->first();
        $cursos = null;
        if(!is_null($profesor))
        {
          $cursos = \DB::table("cursos")->where([
            ["profesores_id_profesores", $profesor->id_profesores],
                            //Si es un curso rechazado no lo muestra
            ["status_id", "!=", "3"]
          ])->get();
        }
        DB::commit();
        return $cursos;
      }
      catch(\Exeption $ex)
      {
        return false;
      }
    }

    public static function proceso_curso_estudiante_horas()
    {
      try
      {
        DB::beginTransaction();
        $profesor = \DB::table("profesores")->where(DB::raw("id_user"),\Auth::user()->id)->first();
        $difference = 0;
        if(!is_null($profesor))
        {
          $cursos = \DB::table("cursos")->where([
            ["profesores_id_profesores", $profesor->id_profesores],
                            //Si son cursos finalizados se cuentan las horas
            ["status_id", "=", "12"]
          ])->get();

          foreach ($cursos as $curso)
          {
            $schedules = \DB::table("schedule")->where("cursos_id_cursos", $curso->id_cursos)->get();
            foreach ($schedules as $schedule)
            {
              $d0 = strtotime(date($schedule->start_day));
              $d1 = strtotime(date($schedule->finish_day));
              $difference += ($d1 - $d0);
            }

          }
          return $difference;
        }
        DB::commit();
        return null;
      }
      catch(\Exeption $ex)
      {
        return false;
      }
    }

    public static function showPolicy($id)
    {
      $estudiante =\DB::table('estudiante_institutos')->where('id_estudiantes_institutos', $id)->first();
      if(!is_null($estudiante))
      {
        return $estudiante->poliza_estudiantes_institutos;
      }
      return null;
    }

    public static function showAuthorizationLetter($id)
    {
      $estudiante =\DB::table('estudiante_institutos')->where('id_estudiantes_institutos', $id)->first();
      if(!is_null($estudiante))
      {
        return $estudiante->carta_autorizacion_estudiantes_institutos;
      }
      return null;
    }
}
