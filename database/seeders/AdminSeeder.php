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
        ['nim' => 'admin'],
        [
            'name' => 'Admin',
            'nim' => 'admin',
            'username' => 'adminprodi@gmail.com',
            'prodi' => 'D3 Teknik Informatika',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]
    );
}
}