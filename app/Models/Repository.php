<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    //
    protected $table= 'repository';
    protected $primaryKey='id_repository';
    public $timestamps=false;
    protected $fillable= [
        'file',
        'url',
        'description'
    ];
    public function calendar()
    {
    	return $this->belongsTo(Calendar::Class, 'id_calendar');
    }
}
