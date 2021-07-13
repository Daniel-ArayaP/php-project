<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CollegeEmail;

class RegisterInstituteRequest extends FormRequest
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
            'nameInstitute' => 'required|string|max:45|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'emailInstitute' => 'required|string|email|max:150',
            'phoneInstitute' => 'required|numeric|digits:8',
            'nameIncharge' => 'required|string|max:45|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'cellPhoneIncharge' => 'required|numeric|digits:8',
            'directionInstitute' => 'required|string|max:45',
            'passwordInstitute' => 'required|string|min:6|confirmed',
            'passwordInstitute_confirmation' => 'required',
            'headquarter' => 'required',
        ];
    }
}

