<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoriesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $records = Inventory::with(['brand', 'office'])
            ->get();

        $result = array();
        foreach($records as $record){
            $result[] = array(
                'Tanggal Pembelian' => $record->purchased_date,
                'Brand Id' => $record->brand_id,
                'Brand' => $record->brand->name,
                'Kategori Id' => $record->category->value,
                'Kategori' => $record->category->label(),
                'Model' => $record->model,
                'Nomor Seri' => $record->serial_number,
                'Kantor Id' => $record->office->code,
                'Kantor' => $record->office->name,
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            'Tanggal Pembelian',
            'Brand Id',
            'Brand',
            'Kategori Id',
            'Kategori',
            'Model',
            'Nomor Seri',
            'Kantor Id',
            'Kantor',
        ];
    }
}
