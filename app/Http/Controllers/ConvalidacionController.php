<?php

namespace App\Http\Controllers;

use App\BL\ConvalidationBL;
use App\Http\Requests\SendEmailConvalidacion;
use App\Http\Requests\SendEmailPreconvalidacion;
use App\Mail\ConvalidacionEstudiante;
use App\Mail\PreConvalidacionEstudiante;
use App\Models\ContenidoCarrera;
use App\Models\RegistroConvalidacionDetalle;
use App\Models\Student;
use App\Models\Period;
use HttpRequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Convalidacion;
use App\Models\ContenidoUniversidad;
use App\Models\Universidad;
use App\Models\Registro;
use http\Exception\UnexpectedValueException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;
use PDF;
use Illuminate\Support\Facades\File as SendFile;
use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;
use HttpException;



class ConvalidacionController extends Controller
{
    //
    public function index()
    {

        $carreraU = DB::table('ulatina_carreras')->get();
        $universidad = DB::table('universidades')->get();

        return view('Convalidacion/index', compact('carreraU', 'universidad'));
    }





    public function storeEstudiante(Request $request)
    {
            if (DB::table('students')->where('students.university_identification', '=', $request->Cedula)->first()) 
            {
                $carreraUlatina = $request->carrerasUlatina;
                $universidad = $request->universidad;

                $person = DB::table('students')
                    ->join('person_profiles', 'person_profiles.id', '=', 'students.person_profile_id')
                    ->select('students.person_profile_id', DB::raw('CONCAT(person_profiles.first_name," ",person_profiles.last_name1," ",person_profiles.last_name2) AS full_name'))
                    ->where('students.university_identification', '=', $request->Cedula)
                    ->get();

                $materiaUla = ContenidoCarrera::query()->where('ulatina_carreras_id_carreras_ulatina', '=', $carreraUlatina)->get(); 
                $materiaProc = DB::table('contenido_universidades')->where('universidades_id_universidades', '=', $universidad)->get();
                $periodo = DB::table('periods')->where('active', '=', 1)->get();
                
                return view('Convalidacion.convalidaciones', compact('person', 'carreraUlatina', 'universidad', 'periodo', 'materiaUla', 'materiaProc', 'carreraUlatina', 'universidad'));
            }
            else
                return back()->with('error','Favor ingresar un valor (Carnet) que se encuentre registrado en la base de datos');
            //Se debe cambiar totalmente este metodo, consulta que el estudiante este registrado
    }



    public function store(Request $request)
    {

        try {
        
            $convalidacion = new Convalidacion();
            $convalidacion->periodo_convalidaciones = $request->dataRequest['codperiodo'];
            $convalidacion->id_carreras_ulatina_convalidaciones = $request->dataRequest['codCarreraUla'];
            $convalidacion->id_universidades_convalidaciones = $request->dataRequest['codigoUnivProc'];
            $convalidacion->students_person_profile_id = $request->dataRequest['codStudent'];
            $convalidacion->save();

            foreach ($request->data as $data) {
                

                if (!Registro::query()->join('registro_convalidacion_detalles as A', 'registros.id_registros', '=', 'A.id_registros')
                    ->where('A.id_convalidaciones', '=', $convalidacion->id_convalidaciones)
                    ->where(function ($query) use ($data) {
                        $query->where([['contenido_carreras_id_contenido_carreras', '=', $data[2]], ['contenido_universidades_id_contenido_universidades', '=', $data[0]]]);
                    })->exists()
                ) {
                
                    $registro = new Registro();
                    $registro->id_carreras_ulatina_registros = $request->dataRequest['codCarreraUla'];
                    $registro->id_universidades_registros = $request->dataRequest['codigoUnivProc'];
                    $registro->contenido_carreras_id_contenido_carreras = $data[2];
                    $registro->contenido_universidades_id_contenido_universidades = $data[0];
                    $registro->save();

                    $registroDetalle = new RegistroConvalidacionDetalle();
                    $registroDetalle->id_registros = $registro->id_registros;
                    $registroDetalle->id_convalidaciones = $convalidacion->id_convalidaciones;
                    $registroDetalle->convalidacion_registros = $data[4];
                    $registroDetalle->observaciones = $data[5];
                    $registroDetalle->save();
                
                }

            }

            return json_encode("DATOS ALMACENADOS CORRECTAMENTE!, GRACIAS");

        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }

       

    }

    public function showConvalidacion($id)
    {
        try {
            $convalidacion = Convalidacion::query()->join('ulatina_carreras as A', 'convalidaciones.id_carreras_ulatina_convalidaciones', '=', 'A.id_carreras_ulatina')
                ->join('universidades as B', 'convalidaciones.id_universidades_convalidaciones', '=', 'B.id_universidades')
                ->join('periods as C', 'convalidaciones.periodo_convalidaciones', '=', 'C.id')
                ->join('students as D', 'convalidaciones.students_person_profile_id', '=', 'D.person_profile_id')
                ->join('person_profiles as E', 'D.person_profile_id', '=', 'E.id')
                ->select(DB::raw('CONCAT(E.first_name," ",E.last_name1," ",E.last_name2) AS full_name'), 'A.id_carreras_ulatina', 'A.nombre_carreras_ulatina', 'B.id_universidades', 'convalidaciones.periodo_convalidaciones', 'convalidaciones.id_convalidaciones', 'convalidaciones.id_carreras_ulatina_convalidaciones', 'convalidaciones.id_universidades_convalidaciones', 'B.nombre_universidades')
                ->where('convalidaciones.id_convalidaciones', '=', $id)
                ->get();

            $registro_convalidaciones = DB::table('registro_convalidacion_detalles as A')
                ->join('registros as B', 'B.id_registros', '=', 'A.id_registros')
                ->join('contenido_carreras as C', 'C.id_contenido_carreras', '=', 'B.contenido_carreras_id_contenido_carreras')
                ->join('contenido_universidades as D', 'D.id_contenido_universidades', '=', 'B.contenido_universidades_id_contenido_universidades')
                ->join('universidades as E', 'E.id_universidades', '=', 'D.universidades_id_universidades')
                ->where('A.id_convalidaciones', '=', $id)
                ->distinct()
                ->get();

            $periodos = DB::table('periods')->get();
            $contenido_carreras = DB::table('contenido_carreras')->where('ulatina_carreras_id_carreras_ulatina', '=', $convalidacion[0]['id_carreras_ulatina'])->get();
            $contenido_universidades = DB::table('contenido_universidades')->where('universidades_id_universidades', '=', $convalidacion[0]['id_universidades'])->get();

            return view('Convalidacion.Modificar', compact('convalidacion', 'periodos', 'registro_convalidaciones', 'contenido_carreras', 'contenido_universidades'));

        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }
    }

    public function ShowMateriasConvalidacion(Request $request)
    {
        try {

            $idconvalidacion = $request['dataRequest']['codconvalidacion'];
            $codperiodo = $request['dataRequest']['codperiodo'];

            $convalidacion = Convalidacion::query()->where('id_convalidaciones', '=', $idconvalidacion)->first();
            $convalidacion->periodo_convalidaciones = $codperiodo;
            $convalidacion->save();

            //Validar datos para eliminar
            if ($request['deleteData']) {
                foreach ($request['deleteData'] as $data) {
                    Registro::query()->where('id_registros', '=', $data)->delete();
                }
            }

            if ($request['data']) {

                foreach ($request['data'] as $data) {
                    //Registro para modificar
                    if (!empty($data[0])) {
                        if ($registro = Registro::query()->findOrFail($data[0])) {

                            $registro->contenido_carreras_id_contenido_carreras = $data[3];
                            $registro->contenido_universidades_id_contenido_universidades = $data[1];

                            $detalle_convalidacion_registro = RegistroConvalidacionDetalle::query()->where('id_registros', '=', $data[0], 'and')
                                ->where('id_convalidaciones', '=', $idconvalidacion)->first();

                            $detalle_convalidacion_registro->convalidacion_registros = $data[5];
                            $detalle_convalidacion_registro->observaciones = $data[6];

                            $detalle_convalidacion_registro->save();
                            $registro->save();
                        }

                    } elseif (empty($data[0])) {
                        //condicion para validar si el registro
                        if (!Registro::query()->join('registro_convalidacion_detalles as A', 'registros.id_registros', '=', 'A.id_registros')
                            ->where('A.id_convalidaciones', '=', $idconvalidacion)
                            ->where(function ($query) use ($data) {
                                $query->where([['contenido_carreras_id_contenido_carreras', '=', $data[3]], ['contenido_universidades_id_contenido_universidades', '=', $data[1]]]);
                            })->exists()
                        ) {

                            $registro = new Registro();
                            $registro->id_carreras_ulatina_registros = $request->dataRequest['codCarreraUla'];
                            $registro->id_universidades_registros = $request->dataRequest['codigoUnivProc'];
                            $registro->contenido_carreras_id_contenido_carreras = $data[3];
                            $registro->contenido_universidades_id_contenido_universidades = $data[1];
                            $registro->save();

                            $registroDetalle = new RegistroConvalidacionDetalle();
                            $registroDetalle->id_registros = $registro->id_registros;
                            $registroDetalle->id_convalidaciones = $idconvalidacion;
                            $registroDetalle->convalidacion_registros = $data[5];
                            $registroDetalle->observaciones = $data[6];
                            $registroDetalle->save();
                        }
                    }
                }
            }

            return json_encode("Datos Modificados Correctamente, Gracias");

        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }

    }

    public function show($id)
    {
        try {

            if (Convalidacion::query()->find($id)) {
                $convalidacion = Convalidacion::query()->join('ulatina_carreras as A', 'convalidaciones.id_carreras_ulatina_convalidaciones', '=', 'A.id_carreras_ulatina')
                    ->join('contenido_universidades as B','convalidaciones.contenido_universidades_id_contenido_universidades','=','B.id_contenido_universidades')
                    ->join('universidades as C', 'convalidaciones.id_universidades_convalidaciones', '=', 'C.id_universidades')
                    ->join('students as D', 'convalidaciones.students_person_profile_id', '=', 'D.person_profile_id')
                    ->join('periods as E', 'convalidaciones.periodo_convalidaciones', '=', 'E.id')
                    ->join('person_profiles as F', 'convalidaciones.students_person_profile_id', '=', 'F.id')
                    ->where('convalidaciones.id_convalidaciones', '=', $id)->get();

                return view('/Convalidacion/descripcion', compact('convalidacion'));
            }

            return back()->with('error','No hay datos referente a su convalidacion:');
        } catch (HttpRequestException $ex) {
            return $ex;
        }
    }


    public function DeteleteConvalidacion($id)
    {
        //Eliminar Convalidacion y sus materias en cascada deacuerdo al id de convalidacion de la tabla intermedia
        try {
            Registro::query()->join('registro_convalidacion_detalles as A', 'registros.id_registros', '=', 'A.id_registros')
                ->where('A.id_convalidaciones', '=', $id)->delete();

            Convalidacion::query()->where('id_convalidaciones', '=', $id)->delete();

            return redirect('/convalidaciones');


        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }}

        public function ModificarConvalidacion($id)
    {
        //Eliminar Convalidacion y sus materias en cascada deacuerdo al id de convalidacion de la tabla intermedia
        try {
            Registro::query()->join('registro_convalidacion_detalles as A', 'registros.id_registros', '=', 'A.id_registros')
                ->where('A.id_convalidaciones', '=', $id)->update();

            Convalidacion::query()->where('id_convalidaciones', '=', $id)->update();

            return redirect('/convalidaciones');


        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        } }





    public function GenerarConvalidacion($id)
    {
        try {
            switch (Auth::user()->role_id) {
                case (5):
                case (1);
                    $data = ConvalidationBL::ConvalidationStudent($id);
                    return view('/reports/convalidacionreport', ['customer_data' => $data['customer_data'], 'registro_convalidaciones' => $data['registro_convalidaciones'], 'flag' => $data['flag'], 'idConvalidacion' => $id, 'user' => Auth::user()->role_id]);
                    break;

            }

        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }
    }

    public function DownloadPdfConvalidacion($id)
    {
        try {
            $data = ConvalidationBL::ConvalidationStudent($id);

            $pdf = PDF::loadView('/Convalidacion/PdfConvalidacion/PdfView', ['customer_data' => $data['customer_data'], 'registro_convalidaciones' => $data['registro_convalidaciones'], 'flag' => $data['flag']]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download($data['customer_data'][0]->full_name . time() . '.pdf');

        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }
    }

    public function imprimirConvalidacionPeriodo()
    {
    try {
        
        $periodo = DB::table('periods');
        $convalidacion = DB::table('convalidaciones')
    
            ->join('periods as B', 'convalidaciones.periodo_convalidaciones', '=', 'B.id')
            ->join('universidades as C', 'convalidaciones.id_universidades_convalidaciones', '=', 'C.id_universidades')
            ->join('students as D', 'convalidaciones.students_person_profile_id', '=', 'D.person_profile_id')
            ->join('periods as E', 'convalidaciones.periodo_convalidaciones', '=', 'E.id')
            ->join('person_profiles as F', 'convalidaciones.students_person_profile_id', '=', 'F.id')

            ->select('convalidaciones.*','B.*','C.*')
            ->paginate(5);

       $pdf = \PDF::loadview('/Convalidacion/PdfConvalidacion/PeriodoReporte', compact('periodo', 'convalidacion'));
        return $pdf->download('Informe.pdf');

        } catch (HttpRequestException $ex) {

    return json_encode($ex);
     }
}


    public function SendEmailPreConvalidacion($idConvalidacion)
    {
        try {
            $data = ConvalidationBL::ConvalidationStudent($idConvalidacion);
            $mailEntity = new PreConvalidacionEstudiante($data['customer_data'][0]->full_name, $data['customer_data'][0]->university_identification, $data['customer_data'][0]->nombre_carreras_ulatina, $data['customer_data'][0]->id_convalidaciones, $data['customer_data'][0]->created_at);
            Mail::to(env('MAIL_USERNAME'))->send($mailEntity);
            return back()->with("status", "El mensaje fue recibido, pronto te avisaremos");

        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }
    }



    public function SendEmailConvalidacion(SendEmailConvalidacion $request)
    {
        ini_set('max_execution_time', 300);
        try {
            $data = ConvalidationBL::ConvalidationStudent($request->idConvalidacion);

            $pdf = PDF::loadView('/Convalidacion/PdfConvalidacion/PdfView', ['customer_data' => $data['customer_data'], 'registro_convalidaciones' => $data['registro_convalidaciones'], 'flag' => $data['flag']]);
            $pdf->setPaper('A4', 'landscape');

            $name = "convalidacion_" . time() . '.pdf';
            file_put_contents(storage_path('app/public/convalidacion/' . $name), $pdf->output());

            $mailEntity = new ConvalidacionEstudiante($data['customer_data'][0]->full_name, $data['customer_data'][0]->nombre_carreras_ulatina, $name);


            if (!empty($request->emailPredeterminado)) {

                Mail::to($request->emailPredeterminado)->send($mailEntity);

            } elseif (!empty($request->emailCustom)) {
                Mail::to($request->emailCustom)->send($mailEntity);
            }

            return back()->with("status", "El mensaje fue recibido, Nos pondremos en contacto pronto.");

        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }
    }
    
}

