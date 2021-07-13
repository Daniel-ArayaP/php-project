<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEncuestaRequest extends FormRequest
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
            'titulo_encuestas' => ['required', 'max:45', 'regex:/^[A-ZAÀÂÇÉÈÊËÍÎÏÓÔÚÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ_., ]+$/'],
            'periodo_encuestas' => ['required','max:45', 'regex:/^[0-9- ]+$/'],
            'cursos_id_cursos' => 'required',
            'profesores_id_profesores' => 'required',
            'pregunta_1' => ['required','max:100', 'regex:/^[A-ZÁÀÂÇÉÈÊËÍÎÏÓÔÚÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ?¿., ]+$/']
            
        ];
    }
    //mensajes de validacion personalizados
    public function messages()
    {
        return[
            'titulo_encuestas.required' => 'El campo "T&iacute;tulo" es obligatorio',
            'titulo_encuestas.max' => 'El campo "T&iacute;tulo" debe tener menos de :max caracteres',
            'titulo_encuestas.regex' => 'El campo "T&iacute;tulo" no acepta caracteres especiales',
            'periodo_encuestas.required' => 'El campo "Cuatrimestre" es obligatorio',
            'periodo_encuestas.max' => 'El campo "Cuatrimestre" debe tener menos de :max caracteres',
            'periodo_encuestas.regex' => 'El formato del campo "Cuatrimestre" es incorrecto',
            'cursos_id_cursos.required' => 'El campo "Curso" es obligatorio',
            'profesores_id_profesores.required' => 'El campo "Profesor" es obligatorio',
            'pregunta_1.required' => 'El campo "Pregunta 1" es obligatorio',
            'pregunta_1.max' => 'El campo "Pregunta 1" debe tener menos de :max caracteres',
            'pregunta_1.regex' => 'El formato del campo "Pregunta 1" es incorrecto'
        ];
    }
}
