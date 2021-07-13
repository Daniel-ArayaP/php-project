<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonProfile extends Model
{
    public $table = "person_profiles";
    public $timestamps = false;
    protected $guarded = [];

    public function student()
    {
    	return $this->hasOne(Student::Class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name1} {$this->last_name2}";
    }
}
