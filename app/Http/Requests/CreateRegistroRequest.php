<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Request;
use validator;

class CreateRegistroRequest extends FormRequest
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
            'carrerasUlatina' => 'required',
            'codigoMateria' => 'required',
            'universidad' => 'required',
            'contenidoUniversidad' => 'required',
            'convalidacion' => 'required'
        ];
    }
}
