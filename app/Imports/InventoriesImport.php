<?php

namespace App\Imports;

use App\Enums\InventoryStatus;
use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InventoriesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Inventory::updateOrInsert(
            ['serial_number' => $row['nomor_seri']],
            [
                'brand_id' => $row['brand_id'],
                'category' => $row['kategori_id'],
                'model' => $row['model'],
                'office_id' => $row['kantor_id'],
                'status' => InventoryStatus::TERSEDIA
            ]
        );

        return null;
    }
}
