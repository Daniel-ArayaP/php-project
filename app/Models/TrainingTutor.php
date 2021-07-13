<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingTutor extends Model
{
    //
    protected $table= 'training_tutor';
    protected $primaryKey='id_training_tutor';
    public $timestamps=false;


    public function user()
    {
    	return $this->belongsTo(User::Class, 'user_id');
    }
    public function trainingCourse()
    {
    	return $this->belongsTo(TrainingCourse::Class, 'id_training_course');
    }
    public function trainingCondition(){
        return $this->belongsTo(TrainingCondition::Class, 'id_training_condition');
    }
}
