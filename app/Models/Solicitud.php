<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table='solicitudes';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $guarded = [

    ];
    public function profile()
    {
    	return $this->belongsTo(PersonProfile::Class, 'person_profile_id');
    }
    public function company()
    {
    	return $this->belongsTo(Company::Class, 'company_id');
    }
    public function project()
    {
    	return $this->belongsTo(Project::Class, 'project_id');
    }
    public function student()
    {
    	return $this->belongsTo(Student::Class, 'student_curriculum');
    }
    public function status(){
        return $this->belongsTo(Status::Class, 'status_id');
    }
}