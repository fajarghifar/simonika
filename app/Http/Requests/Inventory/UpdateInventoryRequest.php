<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRequest extends FormRequest
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
            'brand_id' => [
                'required',
                'string',
                Rule::exists('brands', 'id')
            ],
            'category' => [
                'required',
                'string',
                'max:1'
            ],
            'model' => [
                'required',
                'string',
            ],
            'serial_number' => [
                'required',
                'string',
            ],
            'office_id' => [
                'required',
                'string',
                Rule::exists('offices', 'id')
            ],
            'purchased_date' => [
                'required',
                'date'
            ],
            'photo' => [
                'image',
                'file',
                'max:2048'
            ],
        ];
    }
}
