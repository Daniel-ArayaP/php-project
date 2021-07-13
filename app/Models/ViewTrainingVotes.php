<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewTrainingVotes extends Model
{
    //
    protected $table= 'view_training_votes';
    //protected $primaryKey='id_training_vote';
    public $timestamps=false;

    protected $fillable= [
        'Curso',
        'Estado',
        'Votacion',
        'Tutor'
    ];

    public function user()
    {
    	return $this->belongsTo(User::Class, 'user_id');
    }


}