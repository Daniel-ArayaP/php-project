<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivos_planes_users extends Model
{
    protected $table='obejtivos_planes_users';

    public $timestamps = false;

    protected $fillable = [
        'obejtivos_planes_id_obejtivos_planes',
        'users_id'
    ];
}
