<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AlbumStoreRequest extends FormRequest
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
        //Importante respetar los tamaños de los schemas
        return [
            'name' => 'required|min:1|max:25',
            'description' => 'max:255',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(jsend_fail([$validator->errors()]));
    }
}
