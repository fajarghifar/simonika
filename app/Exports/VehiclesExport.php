<?php

namespace App\Exports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehiclesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $records = Vehicle::with(['brand', 'office'])
            ->get();

        $result = array();
        foreach($records as $record){
            $result[] = array(
                'Brand Id' => $record->brand_id,
                'Brand' => $record->brand->name,
                'Kategori Id' => $record->category->value,
                'Kategori' => $record->category->label(),
                'Model' => $record->model,
                'Nomor Polisi' => $record->license_plate,
                'Tahun Pembuatan' => $record->year,
                'Nomor STNK' => $record->stnk_number,
                'Nomor BPKB' => $record->bpkb_number,
                'Nomor Rangka' => $record->chassis_number,
                'Nomor Mesin' => $record->engine_number,
                'Periode STNK' => $record->stnk_period,
                'Periode Pajak' => $record->tax_period,
                'Kantor Id' => $record->office->code,
                'Kantor' => $record->office->name,
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            'Brand Id',
            'Brand',
            'Kategori Id',
            'Kategori',
            'Model',
            'Nomor Polisi',
            'Tahun Pembuatan',
            'Nomor STNK',
            'Nomor BPKB',
            'Nomor Rangka',
            'Nomor Mesin',
            'Periode STNK',
            'Periode Pajak',
            'Kantor Id',
            'Kantor',
        ];
    }
}
