<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeCalendar extends Model
{
    //
    protected $table= 'type_calendar';
    protected $primaryKey='id_type_calendar';
    public $timestamps=false;
    protected $fillable= [
        'static_name',
        'name'
    ];
}
