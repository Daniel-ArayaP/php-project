<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingCourse extends Model
{
    //
    protected $table= 'training_course';
    protected $primaryKey='id_training_course';
    public $timestamps=false;

    protected $fillable= [
        'area',
        'start_date',
        'end_date',
        'name_course',
        'description',
        'place',
        'is_free',
        'price',
        'created_at',
        'updated_at',
        'closed_at',
        'max_group'
    ];

    public function user()
    {
    	return $this->belongsTo(User::Class, 'user_id');
    }

    public function trainingCondition(){
        return $this->belongsTo(TrainingCondition::Class, 'id_training_condition');
    }
}
