<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investigacion_estados extends Model
{
    protected $table='investigacion_estados';
    protected $primaryKey='id_investigacion_estado';

    public $timestamps = false;

    protected $fillable = [
        'estado_investigaciones',
        'indicador_estados',
        'investigaciones_id_investigaciones'
    ];

    function investigacion(){
        return  $this->belongsTo(Investigacion::class, 'id_investigacion', 'investigaciones_id_investigaciones');
    }
    function obseEstado(){
        return  $this->hasMany(estado_observaciones::class, 'investigacion_estados_id_investigacion_estados');
    }
}
