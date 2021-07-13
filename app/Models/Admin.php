<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
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

    public function messages()
    {
        return $this->hasMany(Message::Class, 'send_by');
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
