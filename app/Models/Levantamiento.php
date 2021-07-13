<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Levantamiento extends Model
{
    
    protected $table = 'estudiantes_levantamientos';
    protected $primaryKey='id_estudiantes_levantamiento';
    public $timestamps = false;
    protected $fillable = [
        'carne_estudiante',
        'nombre_estudiante',
        'id_carreras_ulatina',
        'id_sedes',
        'id_admins',
        'motivo',
        'fecha_solicitud',
        'fecha_revisado',
        'revisado_por',
        'fecha_ultimo_cambio',
        'id_period',
        'id_plan_estudios',
    ];

    public function sede()
    {
    	return $this->hasOne(Sede::Class, 'id_sedes','id_sedes');
    }

    public function career() {
        return $this->hasOne(CarreraUlatina::class, 'id_carreras_ulatina', 'id_carreras_ulatina');
    }
    public function planes() {
        return $this->hasOne(PlanEstudios::class, 'id_plan_estudios', 'id_plan_estudios');
    }

    public function period()
    {
    	return $this->hasOne(Period::Class, 'id', 'id_period');
    }

    public function courses()
    {
    	return $this->hasMany(LevantamientoIndividual::Class, 'id_estudiante_levantamiento', 'id_estudiantes_levantamiento');
    }

    public function profile()
    {
    	return $this->belongsTo(PersonProfile::Class, 'person_profile_id');
    }

    public function approved()
    {
    	return $this->courses->where('estado_solicitud_individual','Aprobada');
    }

    public function estado_solicitud() {
        if($this->fecha_revisado) {
            return 'REVISADO';
        }
        else {
            return 'PENDIENTE';
        }
    }
}
