<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado_observaciones extends Model
{
    protected $table='estado_observaciones';
    protected $primaryKey='id_estado_observaciones';

    public $timestamps = false;

    protected $fillable = [
        'observaciones',
        'investigacion_estados_id_investigacion_estados'
    ];

    function estadosInves(){
        return  $this->belongsTo(Investigacion_estados::class, 'id_investigacion_estados');
    }
    
}
