<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use App\Models\TrainingCourse;
use App\Models\TrainingCondition;
use App\Models\TrainingMatriculate;
use App\Models\TrainingTutor;
use App\Models\TrainingVote;

use App\Mail\CourseStatus;
use Illuminate\Support\Facades\Mail;

use App\Models\Student;

class closeCourses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:courses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will close the courses ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        //$approved = TrainingCondition::where('static_name', '=', 'IN_PROCESS')->value('id_training_condition');
        $today = Carbon::now()->addDays(3)->format('Y-m-d');
        $courses = TrainingCourse::where('start_date','=',$today)->get();
        foreach($courses as $course){
        $matriculados = TrainingMatriculate::where('id_training_course', '=', $course->id_training_course)->count();
        $tutors = TrainingTutor::where('id_training_course','=',$course->id_training_course)->count();
        $email=NULL;

        if($matriculados>=($course->max_group/2) && $tutors>0 ){
           
           $course->id_training_condition=1;
           $course->update();
           $tutors = TrainingTutor::where('id_training_course','=',$course->id_training_course)->orderBy('id_training_tutor','desc')->get();
           $avg=0;

              foreach($tutors as $tutor){
                $correo = $tutor->user->email;
                $avegare = TrainingVote::where('id_training_course','=',$tutor->id_training_course)->where('id_training_tutor','=',$tutor->id_training_tutor)->avg('vote');//pluck
                
                if($avg <= $avegare){
                $avg=$avegare;
                $email= $correo;   
                }
            }   

            $students = TrainingMatriculate::where('id_training_course', '=', $course->id_training_course)->get();
            foreach($students as $student){
            Mail::to($student->user->email)->send(new CourseStatus($course,$email));
            }
                
           Mail::to($email)->send(new CourseStatus($course,$email));

          
            }else{
        $course->id_training_condition=3;
        $course->update();

        $students = TrainingMatriculate::where('id_training_course', '=', $course->id_training_course)->get();
        foreach($students as $student){
        Mail::to($student->user->email)->send(new CourseStatus($course,$email));
        }
        echo "reprobado";      
        }
            
          
   
            
        } 

      
          //cierre
           $fin = Carbon::now()->format('Y-m-d');
          $cierre = TrainingCourse::where('end_date','=',$fin)->get();


           foreach($cierre as $cerrar){
            
                if($cerrar->id_training_condition==1){
           
                    $cerrar->id_training_condition=4;
                    $cerrar->update(); 
                    echo 'cerrado';
                }
                

            }  
 
         

    }
}

