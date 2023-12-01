<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = collect([
            [
                'id'    => 1,
                'code'  => '01',
                'name'  => 'KPO',
                'address'  => 'Jl. KH. Wahid Hasyim No. 03 Astanajapura Kabupaten Cirebon, Jawa Barat',
                'created_at' => now()
            ],
            [
                'id'    => 2,
                'code'  => '02',
                'name'  => 'Beber',
                'address'  => 'Jl. Jendral Sudirman, Ciperna, Talun, Cirebon, West Java 45171',
                'created_at' => now()
            ],
            [
                'id'    => 3,
                'code'  => '03',
                'name'  => 'Cirebon Selatan',
                'address'  => 'Jl. Pangeran Cakra Buana, Kecomberan, Kec. Talun, Cirebon, Jawa Barat 45171',
                'created_at' => now()
            ],
            [
                'id'    => 4,
                'code'  => '04',
                'name'  => 'Ciwaringin',
                'address'  => 'Jl. Urip Sumoharjo No.1, Ciwaringin, Kec. Ciwaringin, Cirebon, Jawa Barat 45161',
                'created_at' => now()
            ],
            [
                'id'    => 5,
                'code'  => '05',
                'name'  => 'Gegesik',
                'address'  => 'Jl. Raya Gegesik Kidul No.50, Gegesik Kidul, Gegesik, Cirebon, Jawa Barat 45164',
                'created_at' => now()
            ],
            [
                'id'    => 6,
                'code'  => '06',
                'name'  => 'Kapetakan',
                'address'  => 'Jl. Sunan Gn. Jati No.76, Karangreja, Suranenggala, Cirebon, Jawa Barat 45152',
                'created_at' => now()
            ],
            [
                'id'    => 7,
                'code'  => '07',
                'name'  => 'Klangenan',
                'address'  => 'Jl. Kh. Wahid Hasyim No.03, Mertapada Wetan, Kec. Astanajapura, Kabupaten Cirebon, Jawa Barat 45181',
                'created_at' => now()
            ],
        ]);

        $offices->each(function ($office){
            Office::insert($office);
        });
    }
}
