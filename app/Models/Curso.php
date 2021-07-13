<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table= 'cursos';
    protected $primaryKey='id_cursos';
    public $timestamps=false;

    protected $fillable= [
        'codigo_cursos',
        'nombre_cursos',
        'grupo_cursos'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->nombre_cursos}";
    }
    public function profesor()
    {
        return $this->belongsTo(Profesor::Class, 'profesores_id_profesores');
    }
     
    //buscar curso por codigo
    public function scopeName($query, $name)
    {
        if(trim($name) != "")
        {
            $query->where('codigo_cursos', $name);
        }
    }
}
