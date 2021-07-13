<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateProjectRequest extends FormRequest
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
            if (Auth::user()->role_id == 2) {
                return true;
            }
            if (Auth::user()->role_id == 3) {
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
            'companyName' => 'required|string|max:45',
            'legal_document' => 'required|string|max:45',
            'contact_name' => 'required|string|max:150',
            'contact_phone' => 'required|string|max:45',
            'contact_email' => 'required|email|max:150',
            //'company_type_id' => 'required|numeric|digits:1',
            //'project_type_id' => 'required|numeric|digits:1',
            'projectName' => 'required|string|max:500',
            'caseStatus' => 'max:1000',
            'toolText' => 'max:3000',
            //'teleworking' => 'required|numeric|digits:1',
            'generalProblem' => 'max:1000',
            'sProblems' => 'max:3000',
            'generalObjetive' => 'max:1000',
            'sObjetives' => 'max:3000',
            'pScopes' => 'max:3000',
            'pLimitations' => 'max:3000',
            //'projectFile' => 'mimes:pdf',
            //'process' => 'required|numeric|digits:1',
            //'modality' => 'required|numeric|digits:1'
        ];
    }
}
