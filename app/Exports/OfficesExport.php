<?php

namespace App\Exports;

use App\Models\Office;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class OfficesExport implements FromCollection, WithHeadings
{
/**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $records = Office::all();

        $result = array();
        foreach($records as $record){
            $result[] = array(
                'Kode' => $record->code,
                'Nama' => $record->name,
                'Alamat' => $record->address
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            'Kode',
            'Nama',
            'Alamat',
        ];
    }
}
