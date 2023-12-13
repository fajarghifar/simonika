<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $records = User::all();

        $result = array();
        foreach($records as $record){
            $result[] = array(
                'Nama' => $record->name,
                'NIP' => $record->nip,
                'NIK' => $record->nik,
                'Id JK' => $record->gender->value,
                'Jenis Kelamin' => $record->gender->label(),
                'Email' => $record->email,
                'Telepon' => $record->phone,
                'Tempat Lahir' => $record->place_of_birth,
                'Tanggal Lahir' => $record->date_of_birth,
                'Alamat' => $record->address,
                'Id Role' => $record->role_id->value,
                'Role' => $record->role_id->label()
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIP',
            'NIK',
            'Id JK',
            'Jenis Kelamin',
            'Email',
            'Telepon',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Id Role',
            'Role',
            'Password'
        ];
    }
}
