<?php

namespace App\Http\Requests\Vehicle;

use App\Enums\VehicleStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'license_plate' => [
                'required',
                'string'
            ],
            'year' => [
                'required',
                'string',
                'max:4'
            ],
            'stnk_number' => [
                'required',
                'string'
            ],
            'bpkb_number' => [
                'required',
                'string'
            ],
            'chassis_number' => [
                'required',
                'string'
            ],
            'engine_number' => [
                'required',
                'string'
            ],
            'stnk_period' => [
                'required',
                'date'
            ],
            'tax_period' => [
                'required',
                'date'
            ],
            'office_id' => [
                'required',
                Rule::exists('offices', 'id')
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
            'status' => VehicleStatus::TERSEDIA
        ]);
    }
}
