<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = 'person_profile_id';
    public $incrementing = false;
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::Class, 'user_id');
    }

}
