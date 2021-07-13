<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $guarded = [];

    public function profile()
    {
    	return $this->belongsTo(Company::Class, 'id');
    }

    public function legal_document()
    {
    	return $this->belongsTo(Company::Class, 'legal_document');
    }

    public function contact_name()
    {
    	return $this->belongsTo(Company::Class, 'contact_name');
    }

    public function teleworking()
    {
    	return $this->belongsTo(Company::Class, 'teleworking');
    }

    public function contact_phone()
    {
    	return $this->belongsTo(Company::Class, 'contact_phone');
    }

    public function contact_email()
    {
    	return $this->belongsTo(Company::Class, 'contact_email');
    }

    public function companyType()
    {
    	return $this->belongsTo(CompanyType::Class, 'company_type_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::Class, 'id');
    }

    public function name()
    {
        return $this->profile['name'];
    }

    public function getCreationDate()
    {
        return $this->created_at->format('d/m/Y');
    }

}
