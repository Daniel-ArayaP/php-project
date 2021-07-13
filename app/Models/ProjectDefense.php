<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDefense extends Model
{
    protected $guarded = [];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['defense_date'];
    
    public function student()
    {
    	return $this->belongsTo(Student::Class, 'student_id');
    }

    public function academicRepresentative()
    {
    	return $this->belongsTo(AcademicRepresentative::Class, 'academic_representative_id');
    }

    public function project()
    {
    	return $this->belongsTo(Project::Class, 'project');
    }

    public function status()
    {
    	return $this->belongsTo(DefenseStatus::Class, 'status_is');
    }

    public function reader()
    {
    	return $this->belongsTo(Tutor::Class, 'reader_id');
    }

    public function period()
    {
    	return $this->belongsTo(Period::Class, 'period_id');
    }

    public function getDate()
    {
        return $this->defense_date->format('d/m/Y');
    }

    public function getTime()
    {
        return date("h:i A", strtotime($this->defense_time));
    }
}
