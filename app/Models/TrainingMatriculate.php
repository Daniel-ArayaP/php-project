<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingMatriculate extends Model
{
    //
    protected $table= 'training_matriculate';
    protected $primaryKey='id_training_matriculate';
    public $timestamps=false;
    public function user()
    {
    	return $this->belongsTo(User::Class, 'user_id');
    }
    public function trainingCourse()
    {
    	return $this->belongsTo(TrainingCourse::Class, 'id_training_course');
    }
}
