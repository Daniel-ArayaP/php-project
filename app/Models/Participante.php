<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table='participantes';
    protected $primaryKey='person_profile_id';
    public $timestamps = false;
    protected $guarded = [

    ];
    public function profile()
    {
    	return $this->belongsTo(PersonProfile::Class, 'person_profile_id');
    }
    public function project()
    {
    	return $this->belongsTo(Project::Class, 'paricipant_project_id');
    }
    public function status(){
        return $this->belongsTo(Status::Class, 'status_id');
    }
    public function period()
    {
    	return $this->belongsTo(Period::Class, 'period_id');
    }
    public function projects()
    {
        return $this->belongsTo(Project::class, 'participant_project_id');
    }
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_person_profile_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'person_profile_id');
    }

}
