<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingCondition extends Model
{
    //
    protected $table= 'training_condition';
    protected $primaryKey='id_training_condition';
    public $timestamps=false;

    protected $fillable= [
        'static_name',
        'name'
    ];


}
