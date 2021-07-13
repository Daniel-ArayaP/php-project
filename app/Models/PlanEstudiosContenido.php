<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanEstudiosContenido extends Model
{
    protected $table = 'plan_estudios_contenido';
    protected $primaryKey = 'id_plan_estudios_contenido';
    public $timestamps = false;
    protected $hidden = ['id_plan_estudios_contenido','id_plan_estudios','actualizado_por','fecha_ultimo_cambio','details'];
    protected $appends = ['name','credits','sensibility'];

    public function plan()
    {
    	return $this->belongsTo(PlanEstudios::Class, 'id_plan_estudios','id_plan_estudios');
    }

    public function getNameAttribute() {
        $name = null;
        if ($this->details) {
            $name = $this->details->nombre_contenido_carreras;
        }
        return $name;
    }

    public function getCreditsAttribute() {
        $credits = null;
        if ($this->details) {
            $credits = $this->details->creditos_contenido_carreras;
        }
        return $credits;
    }

    public function getSensibilityAttribute() {
        $sensibility = null;
        if ($this->details) {
            $sensibility = $this->details->sensibilidad;
        }
        return $sensibility;
    }

    public function details()
    {
        return $this->hasOne(ContenidoCarrera::Class, 'id_contenido_carreras', 'id_contenido_carrera');
    }

    public function toArray() {
        $data = parent::toArray();
        if ($this->details->correquisitos->count() > 0){
            $data['corequisites'] = $this->details->correquisitos->pluck('id_contenido_carreras');      
        }
        return $data;
    }

}
