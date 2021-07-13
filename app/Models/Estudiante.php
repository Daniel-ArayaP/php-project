<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //
    protected $primaryKey = 'id_estudiantes';
    public $timestamps = false;
    public $incrementing = false;
    protected $guarded = [];
}
