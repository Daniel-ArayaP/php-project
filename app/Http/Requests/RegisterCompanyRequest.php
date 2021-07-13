<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ 
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'legal_document' => 'required|numeric',
            'contact_name' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'contact_phone' => 'required|numeric',
            'contact_email' => ['required', 'string', 'email' ,'max:150','unique:companies'],
            'company_type_id' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',           
        ];
    }
}