<?php

namespace App\Http\Requests\VehicleExtension;

use App\Enums\VehicleExtensionStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleExtensionRequest extends FormRequest
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
            'document' => [
                'required',
                'file',
                'max:2048'
            ],
            'vehicle_id' => [
                'required',
                'exists:vehicles,id',
            ],
            'stnk_period' => [
                'date',
                'nullable'
            ],
            'tax_period' => [
                'date',
                'nullable'
            ]
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'status' => VehicleExtensionStatus::PENDING
        ]);
    }
}
