<?php

namespace Database\Factories;

use App\Enums\VehicleStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stnk_number' => $this->faker->randomNumber(8, true),
            'license_plate' => $this->faker->randomNumber(4, true),
            'brand_id' => $this->faker->numberBetween(9, 25),
            'model' => $this->faker->name(),
            'category' => $this->faker->randomElement(['1', '2']),
            'year' => $this->faker->date('Y'),
            'chassis_number' => $this->faker->randomNumber(5, true),
            'engine_number' => $this->faker->randomNumber(5, true),
            'bpkb_number' => $this->faker->randomNumber(8, true),
            'stnk_period' => $this->faker->date('Y-m-d'),
            'tax_period' => $this->faker->date('Y-m-d'),
            'office_id' => $this->faker->numberBetween(1, 7),
            'status' => VehicleStatus::TERSEDIA
        ];
    }
}
