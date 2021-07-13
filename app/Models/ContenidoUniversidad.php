<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContenidoUniversidad extends Model
{
    protected $table='contenido_carreras';
    protected $primaryKey = 'id_contenido_universidades';
    public $incrementing = false;
    protected $guarded = [];

    public function universidad()
    {
        return $this->belongsTo(Universidad::class, 'id_universidades_contenido_universidades');
    }
}
