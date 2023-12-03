<?php

namespace Database\Seeders;

use App\Enums\BrandCategory;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lectronics = collect([
            [
                'name'  => 'HP',
                'category'  => BrandCategory::ELEKTRONIK->value,
                'created_at' => now()
            ],
            [
                'name'  => 'Asus',
                'category'  => BrandCategory::ELEKTRONIK->value,
                'created_at' => now()
            ],
            [
                'name'  => 'Lenovo',
                'category'  => BrandCategory::ELEKTRONIK->value,
                'created_at' => now()
            ],
            [
                'name'  => 'DELL',
                'category'  => BrandCategory::ELEKTRONIK->value,
                'created_at' => now()
            ],
            [
                'name'  => 'Acer',
                'category'  => BrandCategory::ELEKTRONIK->value,
                'created_at' => now()
            ],
            [
                'name'  => 'MSI',
                'category'  => BrandCategory::ELEKTRONIK->value,
                'created_at' => now()
            ],
            [
                'name'  => 'Huawei',
                'category'  => BrandCategory::ELEKTRONIK->value,
                'created_at' => now()
            ],
            [
                'name'  => 'Apple',
                'category'  => BrandCategory::ELEKTRONIK->value,
                'created_at' => now()
            ],
        ]);

        $automotif = collect([
            // Motor
            [
                'name' => 'Honda',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Yamaha',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Suzuki',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Kawasaki',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Ducati',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Vespa',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],

            // OTOMOTIF
            [
                'name' => 'Toyota',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Daihatsu',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Mitsubishi',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Nissan',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Isuzu',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Mazda',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Ford',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Chevrolet',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Volkswagen',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Mercedes-Benz',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'BMW',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Audi',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Lexus',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Subaru',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Kia',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Hyundai',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Peugeot',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Jaguar',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
            [
                'name' => 'Land Rover',
                'category' => BrandCategory::OTOMOTIF->value,
                'created_at' => now()
            ],
        ]);

        $lectronics->each(function ($lectronic){
            Brand::insert($lectronic);
        });

        $automotif->each(function ($automotif){
            Brand::insert($automotif);
        });
    }
}
