<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'admin', 'email' => 'admin@gmail.com',  'status' => 'active', 'role' => 'admin', 'password' => 'admin']);
        User::create(['name' => 'pembeli', 'email' => 'pembeli@gmail.com',  'status' => 'active', 'role' => 'pembeli', 'password' => 'pembeli']);
        User::create(['name' => 'penjual', 'email' => 'penjual@gmail.com',  'status' => 'active', 'role' => 'penjual', 'password' => 'penjual']);
    }
}
