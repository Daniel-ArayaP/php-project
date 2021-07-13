<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicRepresentative extends Model
{
    protected $primaryKey = 'person_profile_id';
    public $incrementing = false;
    protected $guarded = [];

    public function profile()
    {
    	return $this->belongsTo(PersonProfile::Class, 'person_profile_id');
    }

    public function getFullNameAttribute()
    {
        return $this->profile['first_name'] . ' ' . $this->profile['last_name1'] . ' ' . $this->profile['last_name2'];
    }
}
