<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminAndManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'state' => 'admin',
            'password' => '12345678',
        ]);
        User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'state' => 'manager',
            'password' => '12345678',
        ]);
        User::create([
            'name' => 'ali',
            'email' => 'ali@gmail.com',
            'state' => 'user',
            'password' => '12345678',
        ]);
    }
}
