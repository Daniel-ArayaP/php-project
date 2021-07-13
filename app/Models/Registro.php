<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $registro_convalidacion_detalle
 */
class Registro extends Model
{
    //
    protected $table='registros';
    protected $primaryKey = 'id_registros';
    public $fillable = ['id_carreras_ulatina_registros','id_universidades_registros','contenido_carreras_id_contenido_carreras','contenido_universidades_id_contenido_universidades'];
    public $incrementing = true;
    protected $guarded = [];
    public $timestamps = false;


    public function contenidocarrera()
    {
        return $this->belongsTo(ContenidoCarrera::Class, 'id_contenido_carreras_registros');
    }

    public function carreraulatina()
    {
        return $this->belongsTo(CarreraUlatina::Class, 'contenido_carreras_id_carreras_ulatina_contenido_carreras');

    }

    public function universidad()
    {
        return $this->belongsTo(Universidad::Class, 'id_universidades_registros');

    }

    public function contenidouniversidad()
    {
        return $this->belongsToMany(ContenidoUniversidad::Class, 'id_contenido_universidades_registros');
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
