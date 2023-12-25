<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = collect([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'role_id' => 1,
                'password' => bcrypt('password'),
                'created_at' => now()
            ],
            [
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'role_id' => 2,

                'password' => bcrypt('password'),
                'created_at' => now()
            ]
        ]);

        $users->each(function ($user){
            User::factory()->create($user);
        });

        User::factory(10)->create();
    }
}
