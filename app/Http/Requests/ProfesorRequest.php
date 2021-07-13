<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfesorRequest extends FormRequest
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
            'cedula_profesores' => ['required','max:45', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9 ]+$/'],
            'nombre_profesores' => ['required', 'max:45', 'regex:/^[A-ZÁÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ ]+$/'],
            'apellido1_profesores' => ['required','max:45', 'regex:/^[A-ZÁÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ ]+$/'],
            'apellido2_profesores' => ['required','max:45', 'regex:/^[A-ZÁÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ ]+$/'],
        ];
    }
    public function messages()
    {
        return[
            'cedula_profesores.required' => 'El campo "C&eacute;dula" es obligatorio',
            'cedula_profesores.unique' => 'La "C&eacute;dula" ingresada ya esta registrada',
            'cedula_profesores.max' => 'El campo "C&eacute;dula" debe tener menos de :max caracteres',
            'cedula_profesores.regex' => 'El campo "C&eacute;dula" no acepta caracteres especiales',
            'nombre_profesores.required' => 'El campo "Nombre" es obligatorio',
            'nombre_profesores.max' => 'El campo "Nombre" debe tener menos de :max caracteres',
            'nombre_profesores.regex' => 'En el campo "Nombre" solo se pueden digitar letras',
            'apellido1_profesores.required' => 'El campo "Apellido 1" es obligatorio',
            'apellido1_profesores.max' => 'El campo "Apellido 1" debe tener menos de :max caracteres',
            'apellido1_profesores.regex' => 'En el campo "Apellido 1" solo se pueden digitar letras',
            'apellido2_profesores.required' => 'El campo "Apellido 2" es obligatorio',
            'apellido2_profesores.max' => 'El campo "Apellido 2" debe tener menos de :max caracteres',
            'apellido2_profesores.regex' => 'En el campo "Apellido 2" solo se pueden digitar letras',
        ];
    }
}
