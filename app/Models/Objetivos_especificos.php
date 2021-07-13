<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivos_especificos extends Model
{
    protected $table='objetivos_especificos';
    protected $primaryKey='id_objetivos_especificos';

    public $timestamps = false;

    protected $fillable = [
        'desc_objetivos_especificos',
        'investigaciones_id_investigaciones' 
    ];

    function investigacion(){
        return  $this->belongsTo(Investigacion::class, 'id_investigaciones');
    }

}
