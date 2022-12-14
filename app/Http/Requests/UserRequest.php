<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(jsend_fail([$validator->errors()]));
    }

    /*
    Si se quiere sobreescribir los mensajes de error por defecto de laravel
    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is not correct'
        ];
    }
    */
}
