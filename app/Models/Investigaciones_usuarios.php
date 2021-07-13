<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investigaciones_usuarios extends Model
{
    protected $table='investigaciones_usuarios';

    public $timestamps = false;

    protected $fillable = [
        'investigaciones_id_investigaciones',
        'users_id',
        'tipo_participaciones'
    ];

    function investigacion(){
        return  $this->belongsTo(Investigaciones::class, 'id_investigaciones');
    }
    function objPlan(){
        return  $this->belongsTo(Objetivos_planes::class, 'id_objetivos_planes');
    }
    function users(){
        return  $this->belongsTo(User::class, 'id');
    }
}
