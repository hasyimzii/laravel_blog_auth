<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'role_id' => 1,
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
