<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    //
    protected $primaryKey = 'id_universidades';
    public $timestamps = false;
    protected $guarded = [];
}
