<?php

namespace App\Imports;

use App\Models\Vehicle;
use App\Enums\InventoryStatus;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehiclesImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        Vehicle::updateOrInsert(
            ['stnk_number' => $row['nomor_stnk']],
            [
                'brand_id' => $row['brand_id'],
                'category' => $row['kategori_id'],
                'model' => $row['model'],
                'license_plate' => $row['nomor_polisi'],
                'year' => $row['tahun_pembuatan'],
                'bpkb_number' => $row['nomor_bpkb'],
                'chassis_number' => $row['nomor_rangka'],
                'engine_number' => $row['nomor_mesin'],
                'stnk_period' => $row['periode_stnk'],
                'tax_period' => $row['periode_pajak'],
                'office_id' => $row['kantor_id'],
                'status' => InventoryStatus::TERSEDIA
            ]
        );

        return null;
    }
}
