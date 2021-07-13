<?php

namespace App\Models;

use App\RegistroConvalidacionDetalle;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $registro_convalidacion_detalle
 */
class Convalidacion extends Model
{
    //
    protected $primaryKey = 'id_convalidaciones';
    protected $table="convalidaciones";
    public $incrementing = true;

    protected $fillable=['periodo_convalidaciones', 'id_carreras_ulatina_convalidaciones', 'id_universidades_convalidaciones','students_person_profile_id'];
    protected $guarded = [];



    public function carreraulatina()
    {
        return $this->belongsTo(CarreraUlatina::Class, "id_carreras_ulatina_convalidaciones");

    }


    public function universidades()
    {
        return $this->belongsTo(Universidades::Class, "id_universidades_convalidaciones");
    }

    public function registroConvalidacionDetalle(){
        return $this->hasMany(RegistroConvalidacionDetalle::class);
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
