<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivos_planes extends Model
{
    protected $table='obejtivos_planes';
    protected $primaryKey='id_obejtivos_planes';

    public $timestamps = false;

    protected $fillable = [
        'desc_objetivo_planes',
        'resultados_esperados',
        'recursos_objetivos',
        'indicadores_resultados',
        'fecha_inicios',
        'fecha_finales',
        'planes_id_planes' 
    ];

    function plan(){
        return  $this->belongsTo(Planes::class, 'id_planes');
    }
    function users(){
        return  $this->hasMany(Investigacion_usuarios::class, 'objetivos_planes_id');
    }
}
