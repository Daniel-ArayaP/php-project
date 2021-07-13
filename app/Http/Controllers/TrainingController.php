<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingCondition;
use App\Models\TrainingCourse;
use App\Models\TrainingMatriculate;
use App\Models\TrainingTutor;
use App\Models\TrainingTutorCV;
use App\Models\TrainingVote;
use App\Models\ViewTrainingVotes;
use App\Models\PersonProfile;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;

//
/*use Illuminate\Support\Facades\DB;*/
//

use DB;



class TrainingController extends Controller
{

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function trainingList()
    {
        error_reporting(E_ALL ^ E_DEPRECATED);
        $trainingTutor = TrainingTutor::where('user_id', '=', Auth::user()->id)->get();
        $data = array();
        $dataCon = array();
        $dataVote = array();
        $staticName = array();
        $staticName[] = 'APPROVED';
        $staticName[] = 'FINISHED';
        $test=array();
        $trainingCondition = TrainingCondition::whereIn('static_name', $staticName)->get();
        foreach ($trainingCondition as $con) {
            $dataCon[] = $con->id_training_condition;
        }
        $trainingTutorAux = TrainingTutor::whereIn('id_training_condition', $dataCon)->get();
        foreach ($trainingTutorAux as $traiAux) {
            $data[] = $traiAux->id_training_course;
        }
        if (count($trainingTutor) != 0) {
            foreach ($trainingTutor as $trai) {     
                $data[] = $trai->id_training_course;
            }
        }
      
        
        $training = TrainingCourse::orderBy('id_training_course', 'desc')->whereNotIn('id_training_course', $data)
       ->where('id_training_condition','=',2)
        /*->orderBy('id_training_course', 'des')*/
        ->paginate(5);
         foreach ($training as $trainer) {
            $prueba = $trainer->id_training_course;
            $count = TrainingMatriculate::where('id_training_course','=',$prueba)->count();
            $test [] = $count;
        }
       

        


        return view('training.list', compact(
            'training','test'
        ));

       
        $trainingVote = TrainingVote::whereIn('vote', $vote)->get();
        foreach ($trainingVote as $vo) {
            $dataVote[] = $vo->id_training_vote;
        }
    }
    public function adminTraining()
    {
        $training = TrainingCourse::orderBy('id_training_course', 'DEC')->paginate(5);
        $trainingCondition = TrainingCondition::all();
        return view('training.adminList', compact(
            'training', 'trainingCondition'
        ));
    }
    public function trainingCreateView()
    {
        return view('training.create');
    }

    
    public function trainingCreate(Request $request)
    {
        $now = new \DateTime();
        $trainingCourse = new TrainingCourse;
        $trainingCondition = TrainingCondition::where('static_name', '=', 'APPROVED')->get();
        //El curso debe quedar Autorizado automáticamente al crearlo, para que no necesite intervención
        $data=[];
        if (count($trainingCondition) !== 0) {
            foreach ($trainingCondition as $trai) {
                $data[] = $trai->id_training_condition;
            }
            $trainingCourse->area = $request->area;
            $trainingCourse->type=$request->type;
            $trainingCourse->start_date = $request->start_date;
            $trainingCourse->end_date = $request->end_date;
            $trainingCourse->startTime = $request->startTime;
            $trainingCourse->endTime = $request->endTime;
            $trainingCourse->name_course = $request->name_course;
            $trainingCourse->description = $request->description;
            
            $trainingCourse->place = $request->place;
            if($request->place==="zoom"){
             $trainingCourse->sede = 0;
            }else{
                $trainingCourse->sede = $request->sedes;  
            }
         
          

            if ($request->is_free=== '1') {
                // El usuario marcó el checkbox
                $trainingCourse->is_free = 1;
            } else {
                // El usuario NO marcó el chechbox
                $trainingCourse->is_free = 0;
            }
                
            

            $trainingCourse->price = $request->price;
            $trainingCourse->created_at = $now;
            $trainingCourse->user_id = Auth::user()->id;
            $trainingCourse->max_group = $request->max_group;
            $trainingCourse->id_training_condition = $data[0];
            $trainingCourse->save();
            return redirect()->route('trainingList')->with('sucess', 'Datos guardados correctamente.');
        } else {
            return redirect()->route('trainingCreateView')->with('error', 'Debe ingresar datos en la tabla training_condition');
        }
    }
    public function trainingVoteCreateView()
    {
        return view('training.tutorsVoteNewAdd');
    }
    public function trainingVoteCreate(Request $request)
    {
        $now = (new \DateTime())->format('Y-m-d');
        $finicio = $request->start_date;
        $fultimapermitida = strtotime ( '-5 day' , strtotime ( $finicio ) ) ;
        $fultimapermitida = date ( 'Y-m-j' , $fultimapermitida );
        if ($now <= $fultimapermitida){
            $trainingVote = new TrainingVote;
            $trainingVote->id_training_course = $request->curso;
            $trainingVote->vote = $request->voto;
            $trainingVote->id_training_tutor = $request->id_training_tutor;
            $trainingVote->user_id = Auth::user()->id;
            $trainingVote->save();

            $response = array(
                'status' => 'success',
                'msg' => 'Voto registrado con éxito!',
            );
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Hoy '.$now.' se ha denegado el voto, la fecha de inicio del curso es '.$finicio.' y se permite como límite 5 días antes del inicio del curso',
            );
        }
        return \Response::json($response);
        //return redirect()->route('trainingCourseTutorVoteNewAdd')->with(\Response::json($response));
        
    }

    public function trainingDelete(Request $request)
    {
        $trainingCourse = TrainingCourse::find($request->id_training_course);
        $trainingTutor = TrainingTutor::where('id_training_course', '=', $request->id_training_course)->get();
        foreach ($trainingTutor as $trai) {
            $trai->delete();
        }
        $trainingMatriculate = TrainingMatriculate::where('id_training_course', '=', $request->id_training_course)->get();
        foreach ($trainingMatriculate as $ma) {
            $ma->delete();
        }
        $trainingCourse->delete();
        $response = array(
            'status' => 'success',
            'msg' => 'Delete successfully',
        );
        return \Response::json($response);
    }

    public function deleteVote(Request $request)
    {
        $now = (new \DateTime())->format('Y-m-d');
        $finicio = $request->start_date2;
        $fultimapermitida = strtotime ( '-5 day' , strtotime ( $finicio ) ) ;
        $fultimapermitida = date ( 'Y-m-j' , $fultimapermitida );

        if ($now <= $fultimapermitida){
            $trainingVote = TrainingVote::find($request->id_training_vote);
            $trainingVote = TrainingVote::where('id_training_vote', '=', $request->id_training_vote)->get();
            foreach ($trainingVote as $trai) {
                $trai->delete();
            }
        
            //$trainingVote->delete();
            $response = array(
                'status' => 'success',
                'msg' => 'Eliminado con exito',
            );
        }else{
            $response = array(
                'status' => 'error',
                'msg' => 'Hoy '.$now.' se ha denegado un intento de anular un voto, la fecha de inicio del curso es '.$finicio.' y se permite como límite 5 días antes del inicio del curso',
            );
        }
        return \Response::json($response);
    }
    public function deleteVote2(Request $request)
    {
        $now = (new \DateTime())->format('Y-m-d');
        $finicio = $request->start_date; 
        $fultimapermitida = strtotime ( '-5 day' , strtotime ( $finicio ) ) ;
        $fultimapermitida = date ( 'Y-m-j' , $fultimapermitida );
        if ($now <= $fultimapermitida){
            $trainingVote = TrainingVote::find($request->id_training_vote);
            $trainingVote = TrainingVote::where('id_training_vote', '=', $request->id_training_vote)->get();
            foreach ($trainingVote as $trai) {
                $trai->delete();
            }
        
            //$trainingVote->delete();
            $response = array(
                'status' => 'success',
                'msg' => 'Eliminado con exito',
            );
        }else{
            $response = array(
                'status' => 'error',
                'msg' => 'Hoy '.$now.' se ha denegado un intento de anular un voto, la fecha de inicio del curso es '.$finicio.' y se permite como límite 5 días antes del inicio del curso',
            );
        }
        return \Response::json($response);
    }


    public function trainingDetail($id_training_course)
    {
        error_reporting(E_ALL ^ E_DEPRECATED);
        $trainingCourse = TrainingCourse::find($id_training_course);
        return view('training.adminDetail', compact(
            'trainingCourse' 
        ));
    }
    public function trainingEdit(Request $request)
    {
        $trainingCourse = TrainingCourse::find($request->id_training_course);
        $now = new \DateTime();
        $trainingCourse->area = $request->area;
        $trainingCourse->type=$request->type;
        $trainingCourse->start_date = $request->start_date;
        $trainingCourse->end_date = $request->end_date;
        $trainingCourse->startTime = $request->startTime;
        $trainingCourse->endTime = $request->endTime;
        $trainingCourse->name_course = $request->name_course;
        $trainingCourse->description = $request->description;
        $trainingCourse->place = $request->place;
        $trainingCourse->sede = $request->sedes;
        if (Input::get('is_free') === '1') {
            // El usuario marcó el checkbox
            $trainingCourse->is_free = 1;
        } else {
            // El usuario NO marcó el chechbox
            $trainingCourse->is_free = 0;
        }
        $trainingCourse->price = $request->price;
        $trainingCourse->created_at = $now;
        $trainingCourse->user_id = Auth::user()->id;
        $trainingCourse->max_group = $request->max_group;
        $trainingCourse->closed_at = $request->closed_at;
        $trainingCourse->save();
        return redirect()->route('adminTraining')->with('sucess', 'Datos actualizados correctamente.');
    }
    public function trainingEditView($id)
    {
        $trainingCourse = TrainingCourse::find($id);
        return view('training.edit', [
            'trainingCourse', $trainingCourse
        ]);
    }
    public function trainingCourseTutor($id_training_course)
    {
        $data=[];
        $test=[];
        $trainingCourse = TrainingCourse::find($id_training_course);
        $trainingTutor = TrainingTutor::where('id_training_course', '=', $id_training_course)->paginate(5);
        $trainingCondition = TrainingCondition::all();
        $trainingVote = TrainingVote::all();
        foreach ($trainingTutor as $t) {
            $prueba = $t->id_training_course;
            $data = TrainingVote::where('id_training_course','=',$prueba)->where('id_training_tutor','=',$t->id_training_tutor)->sum('vote');
            $contador = TrainingVote::where('id_training_course','=',$prueba)->where('id_training_tutor','=',$t->id_training_tutor)->count();
            //$test[]= ($data/$contador); 
            //$test [] = $data/$contador;
           
            if($contador>0){
            $dato=($data/$contador);
            $num=$dato; //el numero que voy a redondear 
            $res=$num%10; //saco el numero sin decimal 
            $decimal=$num-$res; //resto el numero normal por el numero sin el decimal 

            if($decimal!=0) 
                { 
            if($decimal>=0.5)$res++; 
            else $res+=0.5; 
                } 
                $dato = $res;



           
             //$num = round($dato,0);
            array_push($test,$dato);
            }else{
            array_push($test,0);
            }

            


            
        }

        return view('training.tutors', compact(
            'trainingTutor', 'trainingCourse', 'trainingCondition', 'trainingVote','test'
        ));
    }

    public function trainingCourseTutorVote($id_training_course)
    {
        $trainingCourse = TrainingCourse::find($id_training_course);
        $trainingTutor = TrainingTutor::where('id_training_course', '=', $id_training_course)->paginate(5);
        $trainingCondition = TrainingCondition::all();
        $viewTrainingVotes = ViewTrainingVotes::all();
        $trainingVote = TrainingVote::all();
        $test=[];
        $data=array();
       
       foreach ($trainingTutor as $t) {
            $prueba = $t->id_training_course;
            $data = TrainingVote::where('id_training_course','=',$prueba)->where('id_training_tutor','=',$t->id_training_tutor)->sum('vote');
            $contador = TrainingVote::where('id_training_course','=',$prueba)->where('id_training_tutor','=',$t->id_training_tutor)->count();
            //$test[]= ($data/$contador); 
            //$test [] = $data/$contador;
           
            
          /*   if($contador>0){
            $dato=($data/$contador);
            $num=$dato; //el numero que voy a redondear 
            $res=$num%10; //saco el numero sin decimal 
            $decimal=$num-$res; //resto el numero normal por el numero sin el decimal 

            if($decimal!=0) 
                { 
            if($decimal>=0.5)$res++; 
            else $res+=0.5; 
                } 
                $dato = $res;



           
             //$num = round($dato,0);
            array_push($test,$dato);
            }else{
            array_push($test,0);
            } */

            if($contador>0){
                $dato=($data/$contador);
              $gg=round($dato * 2) / 2;
                array_push($test,$gg);
            }else{
            array_push($test,0);
            } 


            
        }
        
    
        

        return view('training.tutorsVotes', compact(
            'trainingTutor', 'trainingCourse', 'trainingCondition', 'viewTrainingVotes', 'trainingVote','test'
        ));
    }
    public function trainingCourseTutorVoteNew($id_training_course)
    {
        $arrayMyTrainingVotes = array();

        $trainingVote = TrainingVote::where('user_id', '=', Auth::user()->id)->where('id_training_course', '=', $id_training_course)->get();
        foreach ($trainingVote as $tv){
            $arrayMyTrainingVotes[] = $tv->user_id;
        }
        $viewTrainingVotes = ViewTrainingVotes::whereIn('user_id', $arrayMyTrainingVotes)->paginate(5);

        $trainingCourse = TrainingCourse::find($id_training_course);
        $trainingTutor = TrainingTutor::where('id_training_course', '=', $id_training_course)->paginate(5);
        
        return view('training.tutorsVoteNew', compact(
            'trainingTutor', 'trainingCourse', 'viewTrainingVotes', 'trainingVote'
        ));
    }

    public function trainingCourseTutorVoteNewAdd($id_training_course)
    {
        $count=[];
        $trainingCourse = TrainingCourse::find($id_training_course);
        $trainingTutor = TrainingTutor::where('id_training_course', '=', $id_training_course)->paginate(5);
        $trainingCondition = TrainingCondition::all();
        $viewTrainingVotes = ViewTrainingVotes::all();
        $trainingVote = TrainingVote::all();

        // TrainingTutor::where('user_id', '=', Auth::user()->id)->get()
        foreach($trainingTutor as $t){
        $data = TrainingVote::where('id_training_tutor','=',$t->id_training_tutor)->where('user_id', '=', Auth::user()->id)->count();
        array_push($count, $data);
        }
       



        return view('training.tutorsVoteNewAdd', compact(
            'trainingTutor', 'trainingCourse', 'trainingCondition', 'viewTrainingVotes', 'trainingVote','count'
        ));
    }

    public function trainingCourseMatriculate($id_training_course)
    {
        $trainingCourse = TrainingCourse::find($id_training_course);
        $trainingMatriculate = TrainingMatriculate::where('id_training_course', '=', $id_training_course)->paginate(5);
        return view('training.usersMatriculate', compact(
            'trainingMatriculate', 'trainingCourse'
        ));
    }
    public function trainingPostulate(Request $request)
    {
        $trainingTutorCV = TrainingTutorCV::where('user_id', '=', Auth::user()->id)->get();
        $triningCondition = TrainingCondition::where('static_name', '=', 'IN_PROCESS')->get();
        if (count($trainingTutorCV) != 0 and count($triningCondition) != 0) {
            $data = [];
            foreach ($triningCondition as $trai) {
                $data[] = $trai->id_training_condition;
            }
            $trainingTutor = new TrainingTutor;
            $trainingTutor->id_training_course = $request->id_training_course;
            $trainingTutor->user_id = Auth::user()->id;
            $trainingTutor->id_training_condition = $data[0];
            $trainingTutor->save();
            $response = array(
                'status' => 'success',
                'msg' => 'Delete successfully',
            );
            return \Response::json($response);
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'CV is Empty',
            );
            return \Response::json($response);
        }

    }
    public function cvTutorView()
    {
        return view('training.tutorsCV');
    }
    public function createTutorCV(Request $request)
    {
        $trainingTutorCV = new TrainingTutorCV;
        $file = $request->file('file');
        $name = '';
        $now = (new \DateTime())->format('Y.m.d');
        $random = rand(0, 1000);
        $encry = $now . '.' . $random . '.';
        $validatedData = $request->validate([
            'file' => 'max:1000',
        ]);
        //obtenemos el nombre del archivo
        if ($file != null) {
            if ($validatedData) {
                $name = $file->getClientOriginalName();
                //indicamos que queremos guardar un nuevo archivo en el disco local
                Storage::disk('local')->put($encry . $name, \File::get($file));
                Storage::move($encry . $name, 'public/cv/' . $encry . $name);
            }
        }
        $trainingTutorCV->cv = $encry . $name;
        $trainingTutorCV->description = $request->description;
        $trainingTutorCV->user_id = Auth::user()->id;
        $trainingTutorCV->save();
        //da error esto la redireccion esta mala en el servidor
        return redirect()->route('myCv')->with('sucess', 'Su CV ha sido guardado exitosamente');
    }
    public function getTutorCv($user_id)
    {
        $trainingTutorCV = TrainingTutorCV::where('user_id', '=', $user_id)->get();
        return view('training.cv', compact('trainingTutorCV')
        );
    }
    public function myCV()
    {
        $trainingTutorCV = TrainingTutorCV::where('user_id', '=', Auth::user()->id)->get();
        if (count($trainingTutorCV) != 0) {
            $trainingTutorCV = TrainingTutorCV::find($trainingTutorCV[0]->id_training_tutor_cv);
            return view('training.mycv', compact('trainingTutorCV'));
        } else {
            return $this->cvTutorView();
        }

    }
    public function deleteCVFile(Request $request)
    {
        $trainingTutorCV = TrainingTutorCV::find($request->id_training_tutor_cv);
        if (\Storage::exists('cv/' . $trainingTutorCV->cv)) {
            \Storage::delete('cv/' . $trainingTutorCV->cv);
        }
        //$trainingTutorCV->cv = null;
        //$trainingTutorCV->save();
        $trainingTutorCV->delete();
        
        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
            
        );
     return \Response::json($response);
       
      
    }

    public function downloadFile($id_training_tutor_cv)
    {
        $trainingTutorCV = TrainingTutorCV::findOrFail($id_training_tutor_cv); 
        return Storage::Disk("public")->download('cv/'.$trainingTutorCV->cv); 
    }

    public function editCV(Request $request)
    {
        $trainingTutorCV = TrainingTutorCV::find($request->id_training_tutor_cv);
        $file = $request->file('cv');
        $name = '';
        $now = (new \DateTime())->format('Y.m.d');
        $random = rand(0, 1000);
        $encry = $now . '.' . $random . '.';
        $validatedData = $request->validate([
            'cv' => 'max:125000',
        ]);
        //obtenemos el nombre del archivo 
        if ($file != null) {
            if ($validatedData) {
                $name = $file->getClientOriginalName();
                //indicamos que queremos guardar un nuevo archivo en el disco local
                if (\Storage::exists($request->cv) == null) {
                    // \Storage::delete('cv/'.$trainingTutorCV->cv);
                    \Storage::disk('local')->put($encry . $name, \File::get($file));
                    \Storage::move($encry . $name, 'cv/' . $encry . $name);
                }
                $trainingTutorCV->cv = $encry . $name;
            }
        }
        $trainingTutorCV->description = $request->description;
        $trainingTutorCV->save();
        return redirect()->route('myCv')->with('sucess', 'Hoja de vida editada correctamente');
    }
    public function myApplications()
    {
        $trainingTutor = TrainingTutor::where('user_id', '=', Auth::user()->id)->get();
        $array=[];
        foreach ($trainingTutor as $traintu) {
            $array[] = $traintu->id_training_course;
        }
        if (empty($array)) {
            return redirect()->route('trainingList')->with('error', 'No existen postulaciones');
        } else {
            $training = TrainingCourse::whereIn('id_training_course', $array)
            ->orderBy('id_training_course', 'desc')
            ->paginate(5);
        }

        foreach ($training as $trainer) {
            $prueba = $trainer->id_training_course;
            $count = TrainingMatriculate::where('id_training_course','=',$prueba)->count();
            $test[]  = $count;
        }

        return view('training.applications', compact(
            'training','test'
        ));
    }

    public function deleteMyApplications(Request $request)
    {
        $trainingTutor = TrainingTutor::where('user_id', '=', Auth::user()->id)->where('id_training_course', '=', $request->id_training_course);
        $trainingTutor->delete();
        $response = array(
            'status' => 'success',
            'msg' => 'Delete successfully',
        );
        return \Response::json($response);
    }

    public function updateTutorCondition(Request $request)
    {
        $trainingTutor = TrainingTutor::find($request->id_training_tutor);
        $trainingTutor->id_training_condition = $request->id_training_condition;
        $trainingTutor->save();
        $response = array(
            'status' => 'success',
            'msg' => 'Actualizado con exito',
        );
        return \Response::json($response);
    }
    public function updateCourseCondition(Request $request)
    {
        $trainingCourse = TrainingCourse::find($request->id_training_course);
        $trainingCourse->id_training_condition = $request->id_training_condition;
        $trainingCourse->save();
        $trainingCondition = TrainingCondition::find($request->id_training_condition);
        if ($trainingCondition->static_name == 'IN_PROCESS' or $trainingCondition->static_name == 'REPROBATE') {
            $trainingMatriculate = TrainingMatriculate::where('id_training_course', '=', $request->id_training_course)->get();
            foreach ($trainingMatriculate as $ma) {
                $ma->delete();
                $trainingCourse = TrainingCourse::find($request->id_training_course);
                $trainingCourse->max_group = $trainingCourse->max_group + 1;
            }
        }
        $response = array(
            'status' => 'success',
            'msg' => 'Actualizado con exito',
        );
        return \Response::json($response);
    }

    public function updateVote(Request $request)
    {
        $now = (new \DateTime())->format('Y-m-d');
        $finicio = $request->start_date; //Ejm:2019-05-17 - 5 = 2019-05-12 *Desde este día ya no puedo votar o cambiar el voto
        $fultimapermitida = strtotime ( '-5 day' , strtotime ( $finicio ) ) ;
        $fultimapermitida = date ( 'Y-m-j' , $fultimapermitida );
        if ($now <= $fultimapermitida){
            $trainingVote = TrainingVote::find($request->id_training_vote);
            $trainingVote->vote = $request->vote;
            $trainingVote->save();
            
            $response = array(
                'status' => 'success',
                'msg' => 'Actualizado con exito',
            );
        }else{
            $response = array(
                'status' => 'error',
                'msg' => 'Hoy '.$now.' se ha denegado un intento de edición de un voto, la fecha de inicio del curso es '.$finicio.', y se permite como límite 5 días antes del inicio del curso',
            );
        }
        return \Response::json($response);
        
    }
    public function updateVote2(Request $request)
    {
        $now = (new \DateTime())->format('Y-m-d');
        $finicio = $request->start_date; 
        $fultimapermitida = strtotime ( '-5 day' , strtotime ( $finicio ) ) ;
        $fultimapermitida = date ( 'Y-m-j' , $fultimapermitida );
        if ($now <= $fultimapermitida){
            $trainingVote = TrainingVote::find($request->id_training_vote);
            $trainingVote->vote = $request->vote;
            $trainingVote->save();
            
            $response = array(
                'status' => 'success',
                'msg' => 'Actualizado con exito',
            );
        }else{
            $response = array(
                'status' => 'error',
                'msg' => 'Hoy '.$now.' se ha denegado un intento de edición de un voto, la fecha de inicio del curso es '.$finicio.' y se permite como límite 5 días antes del inicio del curso',
            );
        }
        return \Response::json($response);
        
    }


    public function trainingMatriculate()
    {
        $trainingCondition = TrainingCondition::where('static_name', '=', 'APPROVED')->get();
        $array=[];
        $arrayMa = array();
        $data=[];
        $test=[];
        foreach ($trainingCondition as $con) {
            $array[] = $con->id_training_condition;
        }
        $trainingMatriculate = TrainingMatriculate::where('user_id', '=', Auth::user()->id)->get();
        foreach ($trainingMatriculate as $ma) {
            $arrayMa[] = $ma->id_training_course;
        }
        if (count($arrayMa) != 0) {
            $trainingCourse = TrainingCourse::whereIn('id_training_condition', $array)->whereNotIn('id_training_course', $arrayMa)
            ->orderBy('id_training_course','desc')
            ->paginate(5);
        } else {
            $trainingCourse = TrainingCourse::whereIn('id_training_condition', $array)
            ->orderBy('id_training_course','desc')
            ->paginate(5);
        }



        foreach ($trainingCourse as $trainer) {
            $data = $trainer->id_training_course;
            $count = TrainingMatriculate::where('id_training_course','=',$data)->count();
            $test [] = $count;
        }




        return view('training.matriculateList', compact(
            'trainingCourse','test'
        ));
    }
    public function trainingCourseDetail($id_training_course)
    {
        $trainingCourse = TrainingCourse::find($id_training_course);
        return view('training.detail', compact(
            'trainingCourse'
        ));
    }
    public function trainingMatriculateCourse(Request $request)
    {
        $trainingCourse = TrainingCourse::find($request->id_training_course);
        $count =TrainingMatriculate::where('id_training_course','=',$trainingCourse->id_training_course)->count();
        
        if ($trainingCourse->max_group > $count ) {
            $trainingMatriculate = new TrainingMatriculate;
            $trainingMatriculate->id_training_course = $request->id_training_course;
            $trainingMatriculate->user_id = Auth::user()->id;
            $trainingMatriculate->save();
            $trainingCourse->max_group = $trainingCourse->max_group;
            $trainingCourse->save();
            $response = array(
                'status' => 'success',
                'msg' => 'Matriculado con exito',
            );
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'No se puede matricular, grupo lleno',
            );
        }

        return \Response::json($response);
    }
    public function matriculateCourseList()
    {
        $array = array();
        $arrayCon = array();
        $trainingMatriculate = TrainingMatriculate::where('user_id', '=', Auth::user()->id)->get();
        foreach ($trainingMatriculate as $ma) {
            $array[] = $ma->id_training_course;
        }
        $trainingCondition = TrainingCondition::where('static_name', '!=', 'APPROVED')->get();
        foreach ($trainingCondition as $con) {
            $arrayCon[] = $con->id_training_condition;
        }
        $trainingCourse = TrainingCourse::whereIn('id_training_course', $array)->whereNotIn('id_training_condition', $arrayCon)
        ->orderBy('id_training_course','desc')
       ->paginate(5);

       foreach ($trainingCourse as $trainer) {
        $prueba = $trainer->id_training_course;
        $count = TrainingMatriculate::where('id_training_course','=',$prueba)->count();
        $test [] = $count;
    }
        return view('training.myMatriculate', compact(
            'trainingCourse', 'trainingMatriculate','test'
        ));
    }
    public function myVoteList()
    {
        $now = new \DateTime();
        $arrayTrainingVote = array();
        $trainingVote = TrainingVote::where('user_id', '=', Auth::user()->id)->get();
        foreach ($trainingVote as $tv){
            $arrayTrainingVote[] = $tv->user_id;
        }
        
        $viewTrainingVotes = ViewTrainingVotes::whereIn('user_id', $arrayTrainingVote)->paginate(5);
        $trainingCourse = TrainingCourse::all();
        $trainingCondition = TrainingCondition::all();
        $trainingTutor = TrainingTutor::all();
        return view('training.votes', compact('viewTrainingVotes','trainingVote', 'trainingCourse', 'trainingCondition', 'trainingTutor'));
    }


    public function myVoteList4_Cursos()
    {
        $arrayTrainingVote = array();
        $trainingVote = TrainingVote::where('user_id', '=', Auth::user()->id)->get();
        foreach ($trainingVote as $tv){
            $arrayTrainingVote[] = $tv->id_training_course;
        }
        
        $trainingCourse = TrainingCourse::whereIn('id_training_course', $arrayTrainingVote)->paginate(5);
        return view('training.votes', compact('trainingCourse','trainingVote'));
    }
    public function myVoteList3()
    {
        $arrayTrainingVotes = array();
        $viewTrainingVotes = ViewTrainingVotes::where('user_id', '=', Auth::user()->id)->get();
        foreach ($viewTrainingVotes as $tv){
            $arrayTrainingVotes[] = $tv->id_user;
        }
        return view('training.votes', compact('viewTrainingVotes'));
    }
    public function myVoteList2()
    {
        $profiles = array();
        $arrayTrainingTutors = array();
        $arrayUserIds = array();
        $arrayProfiles = array();


        $trainingVote = TrainingVote::where('user_id', '=', Auth::user()->id)->get();
        foreach ($trainingVote as $vo) {
            $arrayTrainingTutors[] = $vo->id_training_tutor;
        }
        $trainingTutor = TrainingTutor::whereIn('id_training_tutor',$arrayTrainingTutors);
        foreach($trainingTutor as $userId) {
            $arrayUserIds[] = $userId->user_id;
        }
        $students = Student::whereIn('user_id',$arrayUserIds);
        foreach($students as $profile){
            $arrayProfiles[] = $profile->person_profile_id;
        }

        $personProfile = PersonProfile::whereIn('id',$arrayProfiles);
        
        return view('training.votes', compact('personProfile'));
    }
    public function matriculateDelete(Request $request)
    {
        $trainingMatriculate = TrainingMatriculate::find($request->id_training_matriculate);
        $trainingCourse = TrainingCourse::find($trainingMatriculate->id_training_course);
        $trainingCourse->save();
        $trainingMatriculate->delete();
        $response = array(
            'status' => 'success',
            'msg' => 'Eliminado con exito',
        );
        return \Response::json($response);
    }


    public function coursesReport()
    {

    $trainingCourses = TrainingCourse::where('id_training_condition',"!=" ,2)
    ->orderBy('end_date','desc')->get();
   /*   ->paginate(5); */
    
    return view('training.report', compact(
        'trainingCourses'
    ));

    

    }
    public function getreport($id_training_course)
    {

             try{


        $course=TrainingCourse::findOrFail($id_training_course);
        $participants=TrainingMatriculate::where('id_training_course','=',$id_training_course)->get();
        $pdf = \PDF::loadview('training.pdf', compact('course','participants'));

        return $pdf->download('training.pdf');
        
             }catch (HttpRequestException $ex) {
                 return json_encode($ex);
             }
       // try {
            //$data = ConvalidationBL::ConvalidationStudent($id);

            //$pdf = PDF::loadView('/Convalidacion/PdfConvalidacion/PdfView', ['customer_data' => $data['customer_data'], 'registro_convalidaciones' => $data['registro_convalidaciones'], 'flag' => $data['flag']]);
            //$pdf->setPaper('A4', 'landscape');
            //return $pdf->download($data['customer_data'][0]->full_name . time() . '.pdf');

        //} catch (HttpRequestException $ex) {
           // return json_encode($ex);
        //}
    }

  


    
    

}
