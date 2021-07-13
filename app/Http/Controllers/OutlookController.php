<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Repository;
use App\Models\TokenStore;
use App\Models\TypeCalendar;
use App\Models\TrainingCourse;
use App\Models\CalendarLibrary;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class OutlookController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mail(Request $request)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();

            $tokenCache = new \App\TokenStore\TokenCache;
            if ($tokenCache->getAccessToken() != null) {
                $graph = new Graph();
                $graph->setAccessToken($tokenCache->getAccessToken());

                $user = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();

                $messageQueryParams = array(
                    // Only return Subject, ReceivedDateTime, and From fields
                    "\$select" => "subject,receivedDateTime,webLink,from",
                    // Sort by ReceivedDateTime, newest first
                    "\$orderby" => "receivedDateTime DESC",
                    // Return at most 10 results

                );

                $getMessagesUrl = '/me/mailfolders/inbox/messages?' . http_build_query($messageQueryParams);
                $mail = $graph->createCollectionRequest('GET', $getMessagesUrl)
                    ->setReturnType(Model\Message::class)
                    ->setPageSize(100);
                $mails = $mail->getPage();
                if (!$this->is_obj_empty($mails)) {
                    $count = count($mails);
                    $messages = $this->paginate($mails, $request);
                } else {
                    $messages = null;
                }
                $count = count($mails);
                $messages = $this->paginate($mails, $request);
                $username = $user->getDisplayName();
                return view('entorno.outlook.mail', compact(
                    'username',
                    'messages'
                ));
            } else {
                return redirect()->route('outlookSignin');
            }
        }
    }
    public function deleteMail(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            $tokenCache = new \App\TokenStore\TokenCache;
            if ($tokenCache->getAccessToken() != null) {
                $graph = new Graph();
                $graph->setAccessToken($tokenCache->getAccessToken());
                $user = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();
                $var = $request->id_mail;
                $getEventsUrl = '/me/messages/' . $var;
                $events = $graph->createRequest('delete', $getEventsUrl)
                    ->setReturnType(Model\Event::class)
                    ->execute();
            $response = array(
                'status' => 'success',
                'msg' => 'Email Eliminado',
            );
                    return \Response::json($response);
            } else {
            return redirect()->route('outlookSignin');
            }
    }

    }
    public function calendar(Request $request)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            $tokenCache = new \App\TokenStore\TokenCache;
            if ($tokenCache->getAccessToken() != null) {
                $graph = new Graph();
                $graph->setAccessToken($tokenCache->getAccessToken());
                $user = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();
                $eventsQueryParams = array(
                    // Only return Subject, Start, and End fields
                    "\$select" => "subject,start,end,webLink",
                    // Sort by Start, oldest first
                    "\$orderby" => "End/DateTime DESC",
                );

                $getEventsUrl = '/me/events?' . http_build_query($eventsQueryParams);
                $doc = $graph->createCollectionRequest('GET', $getEventsUrl)
                    ->setReturnType(Model\Event::class)
                    ->setPageSize(100);
                $docs = $doc->getPage();
                if (!$this->is_obj_empty($docs)) {
                    $count = count($docs);
                    $events = $this->paginate($docs, $request);
                } else {
                    $events = null;
                }
                $username = $user->getDisplayName();
                $typeCalendar = TypeCalendar::all();
                $is_ulatina;
                $posNet = strpos($user->getMail(), 'ulatina.net');
                $posCr = strpos($user->getMail(), 'ulatina.cr');
                $is_ulatina;
                if ($posNet == true || $posCr == true) {
                    $is_ulatina = true;
                } else {
                    $is_ulatina = false;
                }
                $trainingCourse =  TrainingCourse::all();
                
                return view('entorno.outlook.calendar', compact(
                    'is_ulatina',
                    'username',
                    'events',
                    'typeCalendar',
                    'trainingCourse'
                ));
            } else {
                return redirect()->route('outlookSignin');
            }
        }
    }
    public function deleteCalendar(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            $tokenCache = new \App\TokenStore\TokenCache;
            if ($tokenCache->getAccessToken() != null) {
                $graph = new Graph();
                $graph->setAccessToken($tokenCache->getAccessToken());
                $user = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();
                $var = $request->id_calendar;
                $getEventsUrl = '/me/events/' . $var;
                $events = $graph->createRequest('delete', $getEventsUrl)
                    ->setReturnType(Model\Event::class)
                    ->execute();
            $response = array(
                'status' => 'success',
                'msg' => 'Calendario Eliminado',
            );
                    return \Response::json($response);
            } else {
            return redirect()->route('outlookSignin');
            }
    }

    }
 
    public function saveCalendar(Request $request)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            $tokenCache = new \App\TokenStore\TokenCache;
            if ($tokenCache->getAccessToken() != null) {
                $graph = new Graph();
                $graph->setAccessToken($tokenCache->getAccessToken());
                $user = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();
                $var = $request->id_event;
                $getEventsUrl = '/me/events/' . $var;
                $events = $graph->createRequest('GET', $getEventsUrl)
                    ->setReturnType(Model\Event::class)
                    ->execute();
                $result = array();
                $idType = $request->id_type_calendar;
                $result = Calendar::where('id_event', $events->getId())->get();
                if (count($result) == 0) {
                    $isBusy = false;
                    $typeCalendar = TypeCalendar::whereNotIn('static_name', ['ZOOM', 'OTHER'])->get();
                    foreach ($typeCalendar as $type) {
                        if ($type->id_type_calendar == $idType) {
                            $result = Calendar::where('id_type_calendar', '=', $idType)->get();
                            if (count($result) != 0) {
                                foreach ($result as $res) {
                                    $dateObj = date('d/M/Y:H:i:s', strtotime($res->end_time));
                                    $dateObjNew = date('d/M/Y:H:i:s', strtotime($events->getEnd()->getDateTime()));
                                    if ($dateObj == $dateObjNew) {
                                        $isBusy = true;
                                    }
                                }
                            }
                        }
                    }
                    if ($isBusy == false) {
                        if ($user->getMail() != null) {
                            $calendar = new Calendar;
                            $calendar->id_event = $events->getId();
                            $calendar->subject = $events->getSubject();
                            $calendar->body_preview = $this->filterUrl($events->getBodyPreview());
                            $calendar->button_zoom = $events->getLocation()->getDisplayName();
                            $calendar->start_time = $events->getStart()->getDateTime();
                            $calendar->end_time = $events->getEnd()->getDateTime();
                            $calendar->web_link = $events->getWebLink();
                            $calendar->mail = $user->getMail();
                            $calendar->user_id = Auth::user()->id;
                            $calendar->id_type_calendar = $idType;
                            $calendar->type_activity =$request->id_activity;
                            $calendar->id_training_course = $request->id_training_course;
                            $calendar->save();
                        } else {
                            return Redirect('calendar/index')->with('error', 'Inicie sesi&oacute;n con su cuenta institucional Office 365 para alamacenar reuniones.
            Cierre la sesi&oacute;n actual y vuelva a ingresar al sistema con Office 365');
                        }
                    } else {
                        return Redirect('calendar/index')->with('error', 'El dispositivo se encuentra ocupado para esa fecha y hora. Seleccione otra fecha &oacute; hora.');
                    }

                } else {
                    return Redirect('calendar/index')->with('error', 'Los datos del evento ya han sido guardados');
                }
                return redirect()->route('listEvents')->with('sucess', 'Los datos del evento se han guardado correctamente');
            } else {
                return redirect()->route('outlookSignin');

            }
        }
    }

    function saveCalendarLibrary($id_calendar){
        try{
            $exist = CalendarLibrary::where('id_calendar','=',$id_calendar)->count();
            if($exist==0){
            $calendarLibrary = new CalendarLibrary;
            $calendarLibrary->created_at= new \DateTime;
            $calendarLibrary->modified_at = new \DateTime;
            $calendarLibrary->created_by_user  =Auth::user()->id;
            $calendarLibrary->modified_by_user =Auth::user()->id;
            $calendarLibrary->id_calendar = $id_calendar;
            $calendarLibrary->save();
        }else{
            return redirect()->route('listEvents')->with('error', 'Los datos de la biblioteca ya ha sido guardado anteriormente');
        }
        return redirect()->route('listLibrary')->with('sucess', 'Los datos del biblioteca se han guardado correctamente');
        }catch(Exception $e){
            error_Log($e->getMessage());
        }

    }
    function deleteLibrary(Request $request){
        $calendarLibrary = CalendarLibrary::find($request->id_calendar_library);
        $calendarLibrary->delete();
        $response = array(
            'status' => 'success',
            'msg' => 'Biblioteca Eliminada',
        );
        return \Response::json($response);
    }
    function listLibrary(){
        $trainingCourse =  TrainingCourse::all();
        $calendarLibrary =  CalendarLibrary::orderBy('created_at','DESC')->paginate(5);
        return view('entorno.outlook.library',             
        compact(
            'calendarLibrary',
            'trainingCourse' 
        ));
    }
    function searchLibrary(Request $request){
        $trainingCourse =  TrainingCourse::all();
        $Arraycalendar = array();
        if($request->type_activity!="" && $request->id_training_course !=""){
            $calendar = Calendar::where('type_activity','=',$request->type_activity)->
             where('id_training_course','=',$request->id_training_course)->get();
            foreach($calendar as $cal ){
                array_push($Arraycalendar, $cal->id_calendar);
            }
        }elseif($request->type_activity !="" && $request->id_training_course == ""){
            $calendar = Calendar::where('type_activity','=',$request->type_activity)->get();
           foreach($calendar as $cal ){
            array_push($Arraycalendar, $cal->id_calendar);
           }
           
        }elseif($request->type_activity == "" && $request->id_training_course != ""){
            $calendar = Calendar::where('id_training_course','=',$request->id_training_course)->get();
            foreach($calendar as $cal ){
                array_push($Arraycalendar, $cal->id_calendar);
            }
        }elseif($request->type_activity == "" && $request->id_training_course == ""){
            return redirect()->route('listLibrary')->with('error', 'Debe ingresar algun filtro');
        }

        $calendarLibrary =  CalendarLibrary::whereIn('id_calendar',$Arraycalendar)->get();
           
        return view('entorno.outlook.library',             
        compact(
            'calendarLibrary',
            'trainingCourse' 
        ));


    }
    public function searchEvent(Request $request){
        error_log($request->txtSearch); 
        $events = Calendar::orderBy('id_calendar', 'DESC')->where('subject','LIKE',"%$request->txtSearch%")->paginate(3);
        return view('entorno.outlook.events', compact('events'));
    }
    public function listEvents(Request $request)
    {
        $events = Calendar::orderBy('id_calendar', 'DESC')->paginate(3);
        return view('entorno.outlook.events', compact('events'));
    }
    public function listEventsNext(Request $request)
    {
        $date = new \DateTime();  
        $events = Calendar::orderBy('id_calendar', 'DESC')->where('end_time','>', $date)->paginate(3);
        return view('entorno.outlook.events', compact('events'));
    }
    public function listEventsAccomplished(Request $request)
    {
        $date = new \DateTime(); 
        $events = Calendar::orderBy('id_calendar', 'DESC')->where('end_time','<', $date)->paginate(3);
        return view('entorno.outlook.events', compact('events'));
    }

    public function repository($id_calendar)
    {
        return view('entorno.outlook.repository', array(
            'id_event' => $id_calendar,
        ));
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            $tokenCache = new \App\TokenStore\TokenCache;
            if ($tokenCache->getAccessToken() != null) {
                $graph = new Graph();
                $graph->setAccessToken($tokenCache->getAccessToken());

                $user = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();
                $is_ulatina;
                $posNet = strpos($user->getMail(), 'ulatina.net');
                $posCr = strpos($user->getMail(), 'ulatina.cr');
                $is_ulatina;
                if ($posNet == true || $posCr == true) {
                    $is_ulatina = true;
                } else {
                    $is_ulatina = false;
                }
                $userId = Auth::user()->id;
                $tokenStore = TokenStore::where('user_id', '=', $userId);
                $tokenStore->delete();
                unset($_SESSION['oauth_state']);
                Auth::logout();
                session_destroy();
                if ($is_ulatina == true) {
                    return redirect('https://login.microsoftonline.com/common/oauth2/logout?post_logout_redirect_uri=https://www.ulatina.xyz/');
                } else {
                    return redirect('https://entorno.outlook.live.com/owa/logoff.owa');
                }
            } else {
                session_destroy();
                Auth::logout();
                return redirect('/');
            }
        }
    }
    public function filterUrl($cadena_origen)
    {
        //filtro los enlaces normales
        $cadena_resultante = preg_replace("/((http|https|www)[^\s]+)/", '', $cadena_origen);
        //miro si hay enlaces con solamente www, si es así le a&ntilde;ado el http://
        // $cadena_resultante= preg_replace("/ href=\"www/", 'href="http://www', $cadena_resultante);
        return $cadena_resultante;
    }


    public function reporitorySave(Request $request)
    {
        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');
        $name = '';
        $now = (new \DateTime())->format('Y.m.d');
        $random = rand(0, 10000);
        $encry = $now . '.' . $random . '.';
        $validatedData = $request->validate([
            'file' => 'max:125000',
        ]);
        if ($file != null) {
            if ($validatedData) {
                //obtenemos el nombre del archivo
                $name = $file->getClientOriginalName();
                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('local')->put($encry . $name, \File::get($file));
                \Storage::move($encry . $name, 'repository/' . $encry . $name);
            }
        }
        $repository = new Repository;
        $repository->file = $encry . $name;
        $repository->url = $request->url;
        $repository->description = $request->description;
        $repository->id_calendar = $request->id_event;
        $repository->save();
        return redirect('/repository/list/' . $request->id_event)->with('sucess', 'Los datos del Repositorio se guardado exitosamente');
    }

    public function repositoryList($id_calendar)
    {
        $repository = Repository::where('id_calendar', '=', $id_calendar)->paginate(5);
        $result = Calendar::find($id_calendar);
        return view('entorno.outlook.listRepository', ['repository' => $repository, 'id_calendar' => $id_calendar, 'user_id' => $result->user_id]);
    }

    public function downloadRepositoryFile($id_repository)
    {
        $repository = Repository::find($id_repository);
        $storage_path = storage_path();
        $url = $storage_path . '/app/repository/' . $repository->file;
        //verificamos si el archivo existe y lo retornamos
        if (\Storage::exists('repository/' . $repository->file)) {
            return response()->download($url);
        } else {
            return redirect()->route('listEvents')->with('error', 'Error en econtrar el archivo');
        }
    }

    public function deleteRepository(Request $request)
    {
        $repository = Repository::find($request->id_repository);
        $id_calendar = $repository->id_calendar;
        if (\Storage::exists('repository/' . $repository->file)) {
            \Storage::delete('repository/' . $repository->file);
        }
        $repository->delete();
        $response = array(
            'status' => 'success',
            'msg' => 'Repositorio Eliminado',
        );
        return \Response::json($response);
    }

    public function editRepositoryView($id_repository)
    {
        $repository = Repository::find($id_repository);
        return view('entorno.outlook.editRepositoryView', array(
            'repository' => $repository,
        ));
    }

    public function editRepository(Request $request)
    {
        $repository = Repository::find($request->id_repository);
        $id_calendar = $repository->id_calendar;
        $file = $request->file('file');
        $name = '';
        $now = (new \DateTime())->format('Y.m.d');
        $random = rand(0, 10000);
        $encry = $now . '.' . $random . '.';
        $validatedData = $request->validate([
            'file' => 'max:125000',
        ]);
        //obtenemos el nombre del archivo
        if ($file != null) {
            if ($validatedData) {
                $name = $file->getClientOriginalName();
                //indicamos que queremos guardar un nuevo archivo en el disco local
                if (\Storage::exists($request->file) == null) {
                    \Storage::delete('repository/' . $repository->file);
                    \Storage::disk('local')->put($encry . $name, \File::get($file));
                    \Storage::move($encry . $name, 'repository/' . $encry . $name);
                }
                $repository->file = $encry . $name;
            }
        }
        $repository->url = $request->url;
        $repository->description = $request->description;
        $repository->id_calendar = $request->id_event;
        $repository->save();
        return $this->repositoryList($id_calendar);
    }

    public function deleteEvent(Request $request)
    {
        $calendar = Calendar::find($request->id_calendar);
        $repositorys = Repository::where('id_calendar', '=', $request->id_calendar)->get();
        foreach ($repositorys as $repo) {
            $repository = Repository::find($repo->id_repository);
            if (\Storage::exists('repository/' . $repository->file)) {
                \Storage::delete('repository/' . $repository->file);
            }
            $repository->delete();
        }
        $calendar->delete();
        $response = array(
            'status' => 'success',
            'msg' => 'Evento & Repositorios Eliminados',
        );
        return \Response::json($response);
    }

    public function deleteFile(Request $request)
    {
        $repository = Repository::find($request->id_repository);
        if (\Storage::exists('repository/' . $repository->file)) {
            \Storage::delete('repository/' . $repository->file);
        }
        $repository->file = null;
        $repository->save();
        $response = array(
            'status' => 'success',
            'msg' => 'Archivo Eliminado',
        );
        return \Response::json($response);
    }
    protected function paginate($items, $request, $perPage = 10)
    {
        $page = Input::get('page', 1); // Get the ?page=1 from the url
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(
            array_slice($items, $offset, $perPage, true), // Only grab the items we need
            count($items), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()]// We need this so we can keep all old query parameters from the url
        );
    }
    public function is_obj_empty($obj)
    {
        if (is_null($obj)) {
            return true;
        }
        foreach ($obj as $key => $val) {
            return false;
        }
        return true;
    }
}
