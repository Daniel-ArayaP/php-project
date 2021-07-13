<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCourseComments extends FormRequest
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
          'courses4' => 'required',
          'courseComments' => 'nullable|max:1000|regex:/^([0-9,.a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9,.a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        ];
    }

    public function messages()
    {
        return[
            'courseComments.max' => 'El campo Comentarios de tener menos de :max caracteres.',
        ];
    }
}
