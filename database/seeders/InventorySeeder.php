<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;
use App\Enums\InventoryCategory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laptops = collect([
            [
                'model' => 'Thinkpad 14',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Inspiron 15',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'MacBook Air',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Surface Laptop 3',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'ZenBook 14',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Latitude 14',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Yoga C940',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Aspire 5',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'ROG Zephyrus G14',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Envy x360',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Legion Y540',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Pavilion 15',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Swift 3',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Vivobook 15',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
            [
                'model' => 'Omen 15',
                'category' => InventoryCategory::LAPTOP,
                'created_at' => now(),
            ],
        ]);

        $printers = collect([
            [
                'model' => 'LaserJet Pro',
                'category' => InventoryCategory::PRINTER,
                'created_at' => now(),
            ],
            [
                'model' => 'EcoTank',
                'category' => InventoryCategory::PRINTER,
                'created_at' => now(),
            ],
            [
                'model' => 'PIXMA',
                'category' => InventoryCategory::PRINTER,
                'created_at' => now(),
            ],
            [
                'model' => 'OfficeJet',
                'category' => InventoryCategory::PRINTER,
                'created_at' => now(),
            ],
            [
                'model' => 'DeskJet',
                'category' => InventoryCategory::PRINTER,
                'created_at' => now(),
            ]
        ]);

        $computers = collect([
            [
                'model' => 'Mac Mini',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ],
            [
                'model' => 'Pavilion Desktop',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ],
            [
                'model' => 'Aspire TC',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ],
            [
                'model' => 'iMac',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ],
            [
                'model' => 'Surface Studio',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ],
            [
                'model' => 'Mac Pro',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ],
            [
                'model' => 'HP EliteDesk',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ],
            [
                'model' => 'Inspiron Desktop',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ],
            [
                'model' => 'Lenovo ThinkCentre',
                'category' => InventoryCategory::KOMPUTER,
                'created_at' => now(),
            ]
        ]);

        $laptops->each(function ($laptop){
            Inventory::factory()->create($laptop);
        });
        $printers->each(function ($printer){
            Inventory::factory()->create($printer);
        });
        $computers->each(function ($computer){
            Inventory::factory()->create($computer);
        });
    }
}
