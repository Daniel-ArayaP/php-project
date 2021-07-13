<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarreraUlatina extends Model
{
    protected $primaryKey = 'id_carreras_ulatina';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;
    protected $table = "ulatina_carreras";

    public $fillable = [
        'id_carreras_ulatina','nombre_carreras_ulatina','id_sedes',
    ];

    public function name()
    {
        return "{$this->nombre_carreras_ulatina}";
    }

    public function code()
    {
        return "{$this->id_carreras_ulatina}";
    }

    public function courses()
    {
        return $this->hasMany('App\Models\ContenidoCarrera', 'ulatina_carreras_id_carreras_ulatina', 'id_carreras_ulatina');
    }

    public function planes()
{
    return $this->hasMany('App\Models\ContenidoCarrera', 'ulatina_carreras_id_carreras_ulatina', 'id_carreras_ulatina');
}

}
