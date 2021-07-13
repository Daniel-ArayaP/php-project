<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class PlanEstudios extends Model
{
    protected $table = 'plan_estudios';
    protected $primaryKey = 'id_plan_estudios';
    public $timestamps = false;
    public $incrementing = false;
    protected $guarded = [];


    public $fillable = [
        'id_plan_estudios',
        'id_carreras_ulatina',
        'nombre_plan',
    ];
    public function name()
    {
        return "{$this->nombre_plan}";
    }

    public function code()
    {
        return "{$this->id_plan_estudios}";
    }

    public function getplan($carrera=0){

    $value=DB::table('plan_estudios')->where('id_plan_estudios', $carrera)->get();

    return $value;
  }
    public function planes($id){

        return PlanEstudios::where('id_carreras_ulatina','=',$id)
        ->get();
    }

    public function career()
    {
        return $this->hasOne(CarreraUlatina::Class, 'id_carreras_ulatina', 'id_carreras_ulatina');
    }

    public function coursess()
    {
        return $this->hasMany('App\Models\ContenidoCarrera', 'plan_estudios_id_plan_estudios', 'id_plan_estudios');
    }
    public function contenidoCarreras()
    {
        return $this->hasMany(ContenidoCarrera::class, 'id_contenido_carreras', 'id_contenido_carreras');
    }

    public function courses()
    {
        return $this->hasMany(PlanEstudiosContenido::Class, 'id_plan_estudios', 'id_plan_estudios');
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['courses'] = $this->courses;
        $data['LastEditAdmin'] = $this->LastEditAdmin;
        $data['LastEditTime'] = $this->LastEditTime;
        return $data;
    }

    public function getLastEditAdminAttribute()
    {
        if ($this->courses()->count()) {
            return $this->courses()->orderBy('fecha_ultimo_cambio', 'desc')->first()->actualizado_por;
        }
    }

    public function getLastEditTimeAttribute()
    {
        if ($this->courses()->count()) {
            $dateDB = $this->courses()->orderBy('fecha_ultimo_cambio', 'desc')->first()->fecha_ultimo_cambio;
            $date = new DateTime($dateDB);
            return $date->format('h:i:s a m/d/Y');
        }
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }

    /**
     * @inheritDoc
     */
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
