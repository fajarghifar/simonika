<?php

namespace App\Http\Requests\Office;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficeRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                Rule::unique('offices')->ignore($this->office)
            ],
            'name' => [
                'required',
                'string'
            ],
            'address' => [
                'required',
                'string',
            ]
        ];
    }
}
