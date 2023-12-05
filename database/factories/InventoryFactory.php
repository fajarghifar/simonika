<?php

namespace Database\Factories;

use App\Enums\InventoryStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchased_date' => $this->faker->date(),
            'brand_id' => $this->faker->numberBetween(1, 8),
            'office_id' => $this->faker->numberBetween(1, 7),
            'model' => $this->faker->name(),
            'serial_number' => $this->faker->randomNumber(5, true),
            'status' => InventoryStatus::TERSEDIA
        ];
    }
}
