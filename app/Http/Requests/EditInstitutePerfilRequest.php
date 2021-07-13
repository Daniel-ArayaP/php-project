<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\CollegeEmail;

class EditInstitutePerfilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
       /* if (Auth::check()) {
            if (Auth::user()->role_id == 4) {
                return true;
            }
        }*/

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
            'nameInstitute' => 'required|string|max:45|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'phoneInstitute' => 'required|numeric|digits:8',
            'nameIncharge' => 'required|string|max:45|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'cellPhoneIncharge' => 'required|numeric|digits:8',
            'directionInstitute' => 'required|string|max:45',
            'headquarter' => 'required',
            
        ];
    }
}
