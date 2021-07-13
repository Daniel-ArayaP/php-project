<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;

}
