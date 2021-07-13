<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContenidoCarrera extends Model
{
    protected $table = 'contenido_carreras';
    protected $primaryKey = 'id_contenido_carreras';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;

    public $fillable = [
        'id_contenido_carreras',
        'nombre_contenido_carreras',
        'creditos_contenido_carreras',
        'ulatina_carreras_id_carreras_ulatina',
        'sensibilidad',
        'plan_estudios_id_plan_estudios',
    ];

    public function carreraulatina()
    {
        return $this->belongsTo(CarreraUlatina::class, 'id_carreras_ulatina_contenido_carreras');
    }

    public function plan()
    {
        return $this->hasOne(PlanEstudios::Class, 'id_plan_estudios', 'id_plan_estudios');
    }
    public function planscarreras()
    {
        return $this->belongsTo(PlanEstudios::class, 'id_plan_estudios_contenido_carreras');
    }

    public function correquisitos()
    {
        return $this->belongsToMany(ContenidoCarrera::class, 'corequisitos', 'id_contenidos_carrera_pendiente', 'id_contenidos_carrera_por_llevar');
    }
}
