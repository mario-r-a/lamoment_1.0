<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CEO (Super Admin - Bisa segalanya)
        User::create([
            'name' => 'Budi CEO',
            'email' => 'ceo@company.com',
            'password_hash' => Hash::make('passceo'),
            'role' => 'CEO',
            'status' => 'active',
        ]);

        // 2. CFO (Urusan Fund Request)
        User::create([
            'name' => 'Siti CFO',
            'email' => 'cfo@company.com',
            'password_hash' => Hash::make('passcfo'),
            'role' => 'CFO',
            'status' => 'active',
        ]);

        // 3. CMO (Urusan Client & Partner)
        User::create([
            'name' => 'Andi CMO',
            'email' => 'cmo@company.com',
            'password_hash' => Hash::make('passcmo'),
            'role' => 'CMO',
            'status' => 'active',
        ]);

        // 4. COO (Operasional/Events)
        User::create([
            'name' => 'Rina COO',
            'email' => 'coo@company.com',
            'password_hash' => Hash::make('passcoo'),
            'role' => 'COO',
            'status' => 'active',
        ]);
    }
}