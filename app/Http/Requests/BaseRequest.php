<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BaseRequest extends FormRequest
{
    public $errors;
    public $validator;

    /**
     * Handle a failed validation attempt.
     * Override to control the 422 redirection upon validation failure
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     */
    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
        $this->errors = $validator->errors();
    }
}
