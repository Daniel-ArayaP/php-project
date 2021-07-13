<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investigacion extends Model
{
    protected $table='investigaciones';
    protected $primaryKey='id_investigaciones';

    public $timestamps = false;

    protected $fillable = [
        'nombre_investigaciones',
        'justificacion_investigaciones',
        'tipo_investigaciones',
        'publicado_investigaciones',
        'metodologia_investigaciones',
        'presupuesto_investigaciones',
        'objetivo_gnrl_investigaciones',
        'sedes_id_sedes',
        'sedes_nombre_sedes',
        'beneficiario_investigaciones'
    ];

    function estados(){
        return  $this->hasMany(Investigacion_estados::class, 'investigaciones_id_investigacion_estados');
    }
    function objEspe(){
        return  $this->hasMany(Objetivos_especificos::class, 'investigaciones_id_investigacion');
    }
    function plan(){
        return  $this->hasOne(Planes::class, 'investigaciones_id_investigacion');
    }
    function usuarios(){
        return  $this->hasMany(Investigaciones_usuarios::class, 'investigaciones_id_investigacion');
    }
}
