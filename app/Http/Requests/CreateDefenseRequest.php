<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateDefenseRequest extends FormRequest
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
            'student_id' => 'required|numeric',
            'reader_id' => 'required|numeric',
            'defense_date' => 'required|date_format:d-m-Y',
            'defense_time' => 'required|string|max:45',
            'classroom' => 'required|string|max:45'
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
