<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class planRequest extends FormRequest
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
           /* 'nombre'=>'required|max:45',
            'objetivo' => 'required|max:40',
            'resultado' => 'required|max:40',
            'recursos' => 'required|max:40',
            'indicador' => 'required|max:40'*/
        ];
    }
}
