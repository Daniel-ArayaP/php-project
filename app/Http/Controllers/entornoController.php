<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Calendar;
use App\Models\TrainingCourse;
use Carbon\Carbon;
use PDF;
use Mail;
use File;

class entornoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        /* elimina los datos de la session guardados en 
        algun momento en este controlador */
        session()->forget('reporte_eventos');
        session()->forget('resumen');
        
        return view('entorno.inicio');
    }

    public function reportes_index() {
        $courses = TrainingCourse::all();

        /* elimina los datos de la session guardados en 
        algun momento en este controlador */
        session()->forget('reporte_eventos');
        session()->forget('resumen');

        return view('entorno.reportes', compact('courses'));
    }

    /**
     * Este metodo permite obtener el reporte, segun los datos que el
     * usuario elija desde la interfaz.
     * 
     * @access public
     * @param Request $request Datos ingresados por el usuario
     * @return View
     */
    public function reportes_filtro(Request $request) {

        /* se obtienen los datos del request */
        $estado = $request->status;

        $data = [];
        $resumen = [];

        /* se obtienen todos los cursos y eventos de la base de datos $events = Calendar::all();*/
        $courses = TrainingCourse::all();
        $events = Calendar::orderby('start_time', 'DESC')->get();

        $resumen['estado'] = $estado;

        /* El 1 significa que es un evento que esta en progreso, 
        por lo que se deben buscar aquellos eventos que estén
        en progreso. */
        if( $estado == 1) {

            foreach ($events as $event) {
                /* se pregunta a los eventos si estan en progreso */
                if( $event->inProgress() ) {
                    $data[] = $event;
                }
            }
        }

        /* El 2 significa que son eventos pendientes, por lo que se
        buscaran eventos que sean iguales o mayores a la fecha ingresada
        por el usuario. */
        if( $estado == 2 ) {

            foreach ($events as $event) {
                /* se pregunta a los eventos si estan pendientes */
                if( $event->isPending()) {
                    $data[] = $event;
                }
            }
        }

        /* El 3 significa que son eventos realizados, por lo que se buscaran eventos
        donde la fecha de fin sea menor que la fecha seleccionada por el usuario. Ademas
        se debe incluir el tipo de actividad, si es:
        - Curso libre
        - Asesoria
        - Reposicion de clases */
        if( $estado == 3 ) {

            $resumen['actividad'] = $request->activity_type;

            foreach ($events as $event) {
                /* se compara que el evento este completo, y que ademas la actividad
                elegida por el usuario sea la misma del evento */
                if( $event->isDone() && $event->type_activity == $request->activity_type ) {
                    $data[] = $event;
                }
            }
        }

        /* El 4 significa que son eventos por materia, por lo que se buscaran'
        los eventos donde la fecha coincida con el evento y la materia sea la
        misma que la seleccionada por el usuario. */
        if( $estado == 4 ) {
            
            $resumen['fecha_desde'] = $request->startDate;
            $resumen['fecha_hasta'] = $request->endDate;

            $fechaDesde = new Carbon( $request->startDate . 'T00:00:00' );
            $fechaHasta = new Carbon( $request->endDate . 'T23:59:59' );

            $course = TrainingCourse::find( $request->selected_subject );
            $resumen['materia'] = $course->name_course;

            foreach( $events as $event ){
                /* se compara que la fecha del evento, este entre las fechas
                ingresadas por el usuario y que ademas la materia sea
                la misma que la que el usuario eligio */
                if( $event->getStartTime()->between($fechaDesde, $fechaHasta) && $event->id_training_course == $request->selected_subject ) {
                    $data[] = $event;
                }
            }
        }
        
        /* se ponen los datos obtenidos del reporte en una variable de sesion,
        para usarlos posteriormente */
        session()->put('reporte_eventos', $data);
        session()->put('resumen', $resumen);

        return view('entorno.reportes', compact('courses', 'data', 'resumen'));
    }

    /**
     * Permite saber si la fecha ingresada por parámetros es la misma que la
     * fecha del día. La fecha por parámetros debe tener el formato año-mes-dia.
     * 
     * @access private
     * @param string $date Fecha a comparar con la actual
     */
    private function isToday($date) {
        $today = Carbon::now();
        $today_time = strtotime( $today->format('Y-m-d') );

        $date_time = strtotime( $date );

        return $today_time == $date_time;
    }

    /**
     * Este metodo permite generar un archivo PDF para descarga, con los
     * datos del reporte.
     * 
     * @access public
     */
    public function generarPDFReporte() {
        /* se obtienen los datos de la sesion guardados al
        generar el reporte */
        $data = session()->get('reporte_eventos');
        $resumen = session()->get('resumen');

        /* se genera la vista con los datos obtenidos de la sesion y
        se cargan como archivo PDF */
        $pdf = PDF::loadView('entorno.reporte-pdf', ['data'=>$data, 'resumen'=>$resumen]);

        return $pdf->download('ReporteEventos.pdf');
    }

    /**
     * Este metodo permite enviar un correo electronico con un archivo
     * adjunto, el cual es el archivo PDF que contiene los datos del reporte
     * de los eventos colaborativos.
     * 
     * @access public
     * @param Request $request Datos enviados por el usuario
     * @return View 
     */
    public function enviarReportePorCorreo(Request $request) {

        $courses = TrainingCourse::all();

        try {
            $email = $request->email;
    
            /* se define una constante que tendra la ruta donde se encuentra el archivo */
            define('DIR_ARCHIVOS_REPORTES', public_path('archivos/reportes'));
    
            /* si la carpeta no existe, se creará */
            if (!is_dir(DIR_ARCHIVOS_REPORTES)){
                mkdir(DIR_ARCHIVOS_REPORTES, 0755, true);
            }
    
            /* se crea una cadena de texto aleatoria */
            $outputName = str_random(30);
    
            /* a la ruta de la carpeta, se le anexa el nombre aleatorio que se ha creado en la
            linea anterior, haciendo que tenga la extension PDF */
            $pdfPath = DIR_ARCHIVOS_REPORTES.'/'.$outputName.'.pdf';
    
            /* se toman los datos del filtro aplicado */
            $data = session()->get('reporte_eventos');
            $resumen = session()->get('resumen');
    
            /* se coloca el archivo PDF en la carpeta */
            File::put($pdfPath, PDF::loadView('entorno.reporte-pdf', ['data'=>$data, 'resumen'=>$resumen])->output());
    
            /* se envia el email */
            Mail::send('entorno.mail-reporte', ['resumen'=>$resumen], function($message) use ($pdfPath, $email){
                $message->subject('Reporte de eventos colaborativos');
                $message->from( Auth::user()->email, Auth::user()->getPersonProfileName());
                $message->to( $email );
                $message->attach( $pdfPath );
            });
    
            session()->put('sucess', 'El correo ha sido enviado con éxito.');

            return view('entorno.reportes', compact('courses', 'data', 'resumen'));
        }
        catch(\Exception $ex) {
            session()->put('error', 'Ha sucedido un error al enviar el correo.');
            return view('entorno.reportes', compact('courses', 'data', 'resumen'));
        } 
    }
}