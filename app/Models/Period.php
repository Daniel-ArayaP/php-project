<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date'];



    public function admin()
    {
        return $this->belongsTo('Admin', 'created_by');
    }

    public function getCreationDate()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function getStartDate()
    {
        return $this->start_date->format('d/m/Y');
    }

    public function getEndDate()
    {
        return $this->end_date->format('d/m/Y');
    }
}

