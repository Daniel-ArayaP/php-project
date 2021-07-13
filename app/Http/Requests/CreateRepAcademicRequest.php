<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRepAcademicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required|string|max:45',
            'lastName1' => 'required|string|max:45',
            'lastName2' => 'required|string|max:45',
            'phone' => 'required|string|max:45',
            'identification_document' => 'required|string|max:45|unique:academic_representatives,identification_document',
            'email' => 'required|string|email|max:150'
        ];
    }
}
