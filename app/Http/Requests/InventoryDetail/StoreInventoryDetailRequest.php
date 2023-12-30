<?php

namespace App\Http\Requests\InventoryDetail;

use App\Enums\InventoryDetailStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryDetailRequest extends FormRequest
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
            'user_id' => [
                'required',
                'string',
                'exists:users,id'
            ],
            'borrowed_date' => [
                'required',
                'date'
            ]
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'status' => InventoryDetailStatus::PINJAM
        ]);
    }
}
