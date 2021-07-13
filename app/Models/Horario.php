<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table= 'admin_horarios';
    protected $primaryKey='id_horarios';
    public $timestamps=false;
}
