<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingVote extends Model
{
    //
    protected $table= 'training_vote';
    protected $primaryKey='id_training_vote';
    public $timestamps=false;

    protected $fillable= [
        'vote'
    ];

    public function user()
    {
    	return $this->belongsTo(User::Class, 'user_id');
    }
    public function trainingCourse()
    {
    	return $this->belongsTo(TrainingCourse::Class, 'id_training_course');
    }
    public function trainingTutor()
    {
    	return $this->belongsTo(TrainingTutor::Class, 'id_training_tutor');
    }


}