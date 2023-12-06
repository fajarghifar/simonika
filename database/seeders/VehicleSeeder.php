<?php

namespace Database\Seeders;

use App\Enums\VehicleCategory;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motorcycles = collect([
            [
                'brand_id' => '9', // 9 = honda
                'model' => 'ADV150',
                'category' => VehicleCategory::MOTOR,
                'created_at' => now(),
            ],
            [
                'brand_id' => '9',
                'model' => 'Scoopy',
                'category' => VehicleCategory::MOTOR,
                'created_at' => now()
            ],
            [
                'brand_id' => '9',
                'model' => 'PCX160',
                'category' => VehicleCategory::MOTOR,
                'created_at' => now(),
            ],
            [
                'brand_id' => '10',
                'model' => 'Jupiter MX 135',
                'category' => VehicleCategory::MOTOR,
                'created_at' => now(),
            ],
            [
                'brand_id' => '10', // 10 = yamaha
                'model' => 'Vixion',
                'category' => VehicleCategory::MOTOR,
                'created_at' => now(),
            ]
        ]);

        $cars = collect([
            [
                'brand_id' => '15', // 15 = toyota
                'model' => 'Avanza',
                'category' => VehicleCategory::MOBIL,
                'created_at' => now(),
            ],
            [
                'brand_id' => '15',
                'model' => 'Kijang Innova',
                'category' => VehicleCategory::MOBIL,
                'created_at' => now(),
            ],
            [
                'brand_id' => '9',
                'model' => 'Jazz',
                'category' => VehicleCategory::MOBIL,
                'created_at' => now(),
            ],
            [
                'brand_id' => '9',
                'model' => 'Brio',
                'category' => VehicleCategory::MOBIL,
                'created_at' => now(),
            ],
            [
                'brand_id' => '11', // 11 = suzuki
                'model' => 'Ertiga',
                'category' => VehicleCategory::MOBIL,
                'created_at' => now(),
            ],
        ]);

        $motorcycles->each(function ($motorcycle){
            Vehicle::factory()->create($motorcycle);
        });
        $cars->each(function ($car){
            Vehicle::factory()->create($car);
        });
    }
}
