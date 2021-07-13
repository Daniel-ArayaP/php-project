<?php

namespace App\Models;

use App\Models\Convalidacion;
use App\Models\Registro;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $convalidaciones
 */
class RegistroConvalidacionDetalle extends Model
{
    //
    protected $table='registro_convalidacion_detalles';
    protected $primaryKey = 'id';
    protected $fillable=['id_registros','id_convalidaciones','convalidacion_registros','observaciones'];
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];

    public function convalidaciones(){
        return $this->belongsTo(Convalidacion::class);
    }

    public function registros(){
        return $this->belongsTo(Registro::class);
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


