<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admins = [
            ['name' => 'abrham', 'email' => 'abrsh@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Abe',    'email' => 'ab@gmail.com',    'password' => bcrypt('123456')],
            ['name' => 'admin',  'email' => 'admin@gmail.com', 'password' => bcrypt('123456')],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(['email' => $admin['email']], $admin);
        }
    }
}
