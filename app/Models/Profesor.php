<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table= 'profesores';
    protected $primaryKey='id_profesores';
    public $timestamps=false;

    protected $fillable= [
        'cedula_profesores',
        'nombre_profesores',
        'apellido1_profesores',
        'apellido2_profesores'
    ];
     //Funcion para obtener nombre completo del profesor
    public function getFullNameAttribute()
    {
        return "{$this->nombre_profesores} {$this->apellido1_profesores} {$this->apellido2_profesores}";
    }
    
    //buscar profesor por nombre
    public function scopeName($query, $name)
    {
        if(trim($name) != "")
        {
            $query->where('nombre_profesores', $name);
        }
    }
}
