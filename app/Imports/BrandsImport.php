<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BrandsImport implements ToModel, WithHeadingRow {
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Gunakan array tunggal untuk parameter 'updateOrInsert'
        Brand::updateOrInsert(
            ['name' => $row['nama']],
            [
                'category'    => $row['kategori'],
            ]
        );

        return null;
    }
}
