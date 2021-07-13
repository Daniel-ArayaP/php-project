<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
            'courseName' => 'required|string|max:45|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'courseGroup' => 'required|string|max:45',
            'courseCode' => 'required|string|max:45|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'courseStatus' => 'required',
            'headquarter' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'courseName.required' => 'El campo Nombre de Curso es obligatorio.',
            'courseName.regex' => 'El campo Nombre no puede tener caracteres speciales.',
            'courseName.max' => 'El campo Nombre de Curso de tener menos de :max caracteres.',
            'courseCode.required' => 'El campo Código de Curso es obligatorio.',
            'courseCode.regex' => 'El campo Código de Curso no puede tener caracteres speciales.',
            'courseCode.max' => 'El campo Código de Curso debe de tener menos de :max caracteres.',
            'courseGroup.required' => 'El campo Grupo es obligatorio.',
            'courseGroup.max' => 'El campo Grupo debe de tener menos de :max caracteres.',
            'courseStatus.required' => 'El campo Estado de Curso es obligatorio.',
            'headquarter.required' => 'El campo Sede es obligatorio.',

        ];
    }
}
