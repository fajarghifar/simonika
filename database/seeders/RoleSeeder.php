<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect([
            [
                'id' => 1,
                'name' => 'admin',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'user',
                'created_at' => now()
            ],
        ]);

        $roles->each(function ($role){
            Role::insert($role);
        });
    }
}
