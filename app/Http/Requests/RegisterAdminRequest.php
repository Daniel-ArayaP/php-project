<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CollegeEmailEmployees;

class RegisterAdminRequest extends FormRequest
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
            'name' => 'required|string|max:45|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/',
            'lastName1' => 'required|string|max:45|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/',
            'lastName2' => 'required|string|max:45|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/',
            'phone' => 'required|numeric',
            'email' => ['required', 'string', 'email' ,'max:150', new CollegeEmailEmployees, 'unique:users'],
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * @inheritDoc
     */
    public function validateResolved()
    {
        // TODO: Implement validateResolved() method.
    }
}
