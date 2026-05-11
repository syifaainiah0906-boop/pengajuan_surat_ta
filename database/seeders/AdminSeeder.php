<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'adminprodi@gmail.com'],
            [
                'name' => 'Admin',
                'nim' => 'admin',
                'prodi' => 'D3 Teknik Informatika',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );

        User::create([
            'name' => 'BAA',
            'nim' => 'baa',
            'prodi' => 'D3 Teknik Informatika',
            'username' => 'baa@gmail.com',
            'role' => 'baa',
            'password' => Hash::make('password123'),
        ]);
    }
}