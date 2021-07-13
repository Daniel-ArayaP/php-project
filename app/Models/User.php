<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'email',
        'password',
        'role_id',
        'last_login_date',
        'fail_attempt_count',
        'is_active',
        'is_locked_out',
        'lock_start_date_time'
    ];

    public function getIndexPage() 
    {
        switch ($this->role_id) 
        {
            case 1: return 'adminUsersI';
            case 2: return 'studentHome';
            case 3: return 'company';
            case 4: return 'instituteHome';
        }
        return "studentHome";
    }

    private function getProfileUser() 
    {
        switch ($this->role_id)
        {
            case '1':   return Admin::where('user_id', $this->id)->first();    
            case '2':   return Student::where('user_id', $this->id)->first();
            default:    return 0;
        }
    }

    public function getProfileUserID() {
        return $this->getProfileUser()->person_profile_id;
    }

    public function getPersonProfileName()
    {
        $uid = $this->getProfileUserID();
        $person = PersonProfile::where('id', '=', $uid)->first();
        return $person->first_name . " " . $person->last_name1;
    }

    public function getRememberToken()
    {
        return '';
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        // just anything that's not actually on the model
        return 'trash_attribute';
    }

    /**
     * Fake attribute setter so that Guard doesn't complain about
     * a property not existing that it tries to set.
     *
     * Does nothing, obviously.
     */
    public function setTrashAttributeAttribute($value)
    {
    }

    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function admin()
    {
        return $this->hasOne('App\Models\Admin');
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