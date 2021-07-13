<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class SendEmailConvalidacion extends FormRequest
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
            'idConvalidacion' => 'numeric',
            'emailPredeterminado' => 'required_without:emailCustom',
            'emailCustom' => 'required_without:emailPredeterminado',
        ];
    }

    public function messages()
    {
        return [
            'idConvalidacion.required' => 'The Id Convalidation is required',
            'emailPredeterminado.required' => 'A email is required',
            'emailCustom.required' => 'A email is required',
        ];
    }

}
