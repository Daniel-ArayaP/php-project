<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    protected $table='planes';
    protected $primaryKey='id_planes';

    public $timestamps = false;

    protected $fillable = [
        'nombre_planes',
        'periodo_planes',
        'investigaciones_id_investigaciones' 
    ];

    function investigacion(){
        return  $this->belongsTo(Investigacion::class, 'id_investigaciones');
    }
    function objePlanes(){
        return  $this->hasMany(Objetivos_planes::class, 'planes_id_planes');
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
