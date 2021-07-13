<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingTutorCV extends Model
{
    //
    protected $table= 'training_tutor_cv';
    protected $primaryKey='id_training_tutor_cv';
    public $timestamps=false;

    protected $fillable= [
        'cv',
        'description'

    ];
    public function user()
    {
    	return $this->belongsTo(User::Class, 'user_id');
    }
}
