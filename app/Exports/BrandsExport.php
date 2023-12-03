<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BrandsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $records = Brand::all();

        $result = array();

        foreach($records as $record){
            $result[] = array(
                'Nama' => $record->name,
                'Kategori' => $record->category->value
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kategori'
        ];
    }
}
