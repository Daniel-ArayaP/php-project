<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    
    public function student()
    {
    	return $this->belongsTo(Student::Class, 'student_id');
    }

    public function projectType()
    {
    	return $this->belongsTo(ProjectType::Class, 'project_type_id');
    }

    public function company()
    {
    	return $this->belongsTo(Company::Class, 'company_id');
    }

    public function status()
    {
    	return $this->belongsTo(Status::Class, 'status_id');
    }

    public function process()
    {
        return $this->belongsTo(ProcessType::Class, 'process_type_id');
    }

    public function modality()
    {
        return $this->belongsTo(Modality::Class, 'modality_id');
    }

    public function getCreationDate()
    {
        return $this->created_at->format('d/m/Y');
    }
}
