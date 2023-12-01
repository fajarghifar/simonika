<?php

namespace App\Imports;

use App\Models\Office;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OfficesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Gunakan array tunggal untuk parameter 'updateOrInsert'
        Office::updateOrInsert(
            ['code' => $row['kode']],
            [
                'name'    => $row['nama'],
                'address' => $row['alamat'], // Ganti 'nama' dengan 'alamat'
            ]
        );

        return null;
    }
}
