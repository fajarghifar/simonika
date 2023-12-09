<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required',
                'string'
            ],
            'nip' => [
                'required',
                'string'
            ],
            'nik' => [
                'required',
                'string'
            ],
            'gender' => [
                'required',
                'string'
            ],
            'address' => [
                'required',
                'string'
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
                'email',
                'max:50',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'photo' => [
                'image',
                'max:1024'
            ],
        ];

        return $rules;
    }

    /**
     * Setelah proses validasi, atur email_verified_at jika email berubah.
     */
    protected function prepareForValidation()
    {
        if ($this->input('email') !== $this->user()->email) {
            $this->merge(['email_verified_at' => null]);
        }
    }
}
