<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'schedule';
 
    public function period()
    {
    	return $this->belongsTo(Period::Class, 'id');
    }

    protected $dates = ['start_date', 'end_date'];
    
    public function admin()
    {
        return $this->belongsTo(Admin::Class, 'created_by');
    }

    public function modality()
    {
        return $this->belongsTo(Modality::Class, 'modalities_id');
    }

    
}
