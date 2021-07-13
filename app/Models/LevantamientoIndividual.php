<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevantamientoIndividual extends Model
{
    
    protected $table = 'solicitud_individual';
    protected $primaryKey= 'id_solicitud_individual';
    public $timestamps = false;
    protected $fillable = [
        'id_estudiante_levantamiento',
        'motivo_estudiante',
        'estado_solicitud_individual',
        'fecha_ultimo_cambio',
        'id_contenido_carrera'
    ];

    public function course()
    {
        return $this->hasOne(ContenidoCarrera::Class, 'id_contenido_carreras', 'id_contenido_carrera');
    }
}
