<?php

namespace App\Http\Requests\User;

use App\Enums\Role;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
                Rule::unique('users', 'nip')
            ],
            'nik' => [
                'required',
                'string',
                Rule::unique('users', 'nik')
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
                Rule::unique('users', 'email')
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('users', 'phone')
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
            'password' => [
                'required',
                'confirmed',
                Password::defaults()
            ],
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'role_id' => Role::USER
        ]);
    }
}
