<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CollegeEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $email = explode('@', $value);

        if ($email[1] == env('COLLEGE_EMAIL_DOMAIN', 'ulatina.net')) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Dirección de correo inválida. Debe ser @ulatina.net';
    }
}
