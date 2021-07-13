<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $primary_key = ['date_time', 'module'];
    public $incrementing = false;
    public $timestamps = false;
}
