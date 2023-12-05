<?php

namespace App\Http\Requests\Inventory;

use App\Enums\InventoryStatus;
use Illuminate\Validation\Rule;
use App\Enums\InventoryCategory;
use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
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
                Rule::exists('brands', 'id')
            ],
            'category' => [
                'required',
                'string',
                'max:1'
            ],
            'model' => [
                'required',
                'string'
            ],
            'serial_number' => [
                'required',
                'string'
            ],
            'office_id' => [
                'required',
                Rule::exists('offices', 'id')
            ],
            'purchased_date' => [
                'required',
                'date'
            ],
            'photo' => [
                'nullable',
                'image',
                'max:2048'
            ],
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'status' => InventoryStatus::TERSEDIA
        ]);
    }
}
