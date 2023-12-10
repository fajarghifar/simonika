<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => [
                'required',
                'string'
            ],
            'gender' => [
                'required',
                'string'
            ],
            'nip' => [
                'required',
                'string',
                Rule::unique('users', 'nip')->ignore($this->user)
            ],
            'nik' => [
                'required',
                'string',
                Rule::unique('users', 'nik')->ignore($this->user)
            ],
            'place_of_birth' => [
                'required',
                'string'
            ],
            'date_of_birth' => [
                'required',
                'date'
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($this->user)
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('users', 'phone')->ignore($this->user)
            ],
            'address' => [
                'required',
                'string'
            ],
            'photo' => [
                'nullable',
                'image',
                'max:2048'
            ],
            'role_id' => [
                'required',
                'string'
            ]
        ];
    }
}
