<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role'=>1,
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'role'=>1,
            'password' => bcrypt('12345678'),
        ]);
    }
}
