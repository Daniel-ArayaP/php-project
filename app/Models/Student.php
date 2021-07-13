<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $primaryKey = 'person_profile_id';
    public $incrementing = false;
    protected $guarded = [];

    public function profile()
    {
    	return $this->belongsTo(PersonProfile::Class, 'person_profile_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::Class, 'user_id');
    }

    public function role_id()
    {
    	return $this->belongsTo(Role::Class, 'id');
    }

    public function gender()
    {
    	return $this->belongsTo(Gender::Class, 'gender_id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_profile_id');
    }

    public function tutors()
    {
        return $this->belongsToMany(Tutor::class);
    }

    public function period()
    {
    	return $this->belongsTo(Period::Class, 'period_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::Class, 'student_id', 'person_profile_id');
    }

    public function defenses()
    {
        return $this->hasMany(ProjectDefense::Class, 'student_id', 'person_profile_id');
    }

    public function getFullNameAttribute()
    {
        return $this->profile['first_name'] . ' ' . $this->profile['last_name1'] . ' ' . $this->profile['last_name2'];
    }

    public function getCreationDate()
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * @inheritDoc
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }

    /**
     * @inheritDoc
     */
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
