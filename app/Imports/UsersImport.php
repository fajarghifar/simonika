<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $existingUser = User::where('nip', $row['nip'])->first();

        if ($existingUser) {
            $existingUser->update([
                'name' => $row['nama'],
                'nik' => $row['nik'],
                'gender' => $row['id_jk'],
                'email' => $row['email'],
                'phone' => $row['telepon'],
                'place_of_birth' => $row['tempat_lahir'],
                'date_of_birth' => $row['tanggal_lahir'],
                'address' => $row['alamat'],
                'role_id' => $row['id_role'],
            ]);
        } else {
            User::create([
                'nip' => $row['nip'],
                'name' => $row['nama'],
                'nik' => $row['nik'],
                'gender' => $row['id_jk'],
                'email' => $row['email'],
                'phone' => $row['telepon'],
                'place_of_birth' => $row['tempat_lahir'],
                'date_of_birth' => $row['tanggal_lahir'],
                'address' => $row['alamat'],
                'role_id' => $row['id_role'],
                'password' => bcrypt($row['password'] ?? 'password'),
            ]);
        }

        return null;
    }
}
