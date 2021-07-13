<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table= 'encuestas';
    protected $primaryKey='id_encuestas';
    public $timestamps=false;

    public function profesor()
    {
        return $this->belongsTo(Profesor::Class, 'profesores_id_profesores');
    }
    public function curso()
    {
        return $this->belongsTo(Curso::Class, 'cursos_id_cursos');
    }

    //buscar evaluacion por titulo
    public function scopeName($query, $titulo)
    {
        if(trim($titulo) != "")
        {
            $query->where('titulo_encuestas', $titulo);
        }
    }
    
}
