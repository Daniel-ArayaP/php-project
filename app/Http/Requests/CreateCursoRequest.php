<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCursoRequest extends FormRequest
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
            'codigo_cursos' => ['required', 'max:45', 'regex:/^[A-ZÁÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-záàâçéèêëîïôûùüÿñæœ0-9- ]+$/'],
            'nombre_cursos' => ['required', 'max:45', 'regex:/^[A-ZÁÀÂÇÉÈÊËÍÎÏÓÔÚÛÙÜŸÑÆŒa-zàâçéèêëíîïóôúûùüÿñæœ0-9. ]+$/'],
            'grupo_cursos' => 'required|numeric'
        ];
    }
    //mensajes de valiadacion personalizados
    public function messages()
    {
        return[
            'codigo_cursos.required' => 'El campo "C&oacute;digo" es obligatorio',
            'codigo_cursos.max' => 'El campo "C&oacute;digo" debe tener menos de :max caracteres',
            'codigo_cursos.regex' => 'El formato del campo "C&oacute;digo" es incorrecto',
            'nombre_cursos.required' => 'El campo "Nombre" es obligatorio',
            'nombre_cursos.max' => 'El campo "Nombre" debe tener menos de :max caracteres',
            'nombre_cursos.regex' => 'El campo "Nombre" no acepta caracteres especiales',
            'grupo_cursos.required' => 'El campo "Grupo" es obligatorio',
            'grupo_cursos.numeric' => 'El campo "Grupo" solo se acepta n&uacute;meros',
            'profesores_id_profesores.required' => 'El campo "Profesor" es obligatorio'
        ];
    }
}
