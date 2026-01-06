<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ CHECK: Jangan buat user CEO jika sudah ada
        $ceoExists = User::where('email', env('ADMIN_EMAIL', 'admin@lamoment.id'))->exists();
        
        if (!$ceoExists) {
            // 1. CEO (Super Admin) - Password dari Environment Variable
            User::create([
                'name' => env('ADMIN_NAME', 'La Moment Admin'),
                'email' => env('ADMIN_EMAIL', 'admin@lamoment.id'),
                'password_hash' => Hash::make(env('ADMIN_PASSWORD', 'DefaultPassword123!')),
                'role' => 'CEO',
                'status' => 'active',
            ]);

            echo "CEO user created successfully!\n";
        } else {
            echo "CEO user already exists, skipping...\n";
        }

        // Optional: Create other default users (CFO, CMO, COO)
        // Uncomment jika diperlukan untuk testing
        /*
        if (!User::where('email', 'cfo@lamoment.id')->exists()) {
            User::create([
                'name' => env('CFO_NAME', 'CFO User'),
                'email' => env('CFO_EMAIL', 'cfo@lamoment.id'),
                'password_hash' => Hash::make(env('CFO_PASSWORD', 'DefaultPassword123!')),
                'role' => 'CFO',
                'status' => 'active',
            ]);
        }

        if (!User::where('email', 'cmo@lamoment.id')->exists()) {
            User::create([
                'name' => env('CMO_NAME', 'CMO User'),
                'email' => env('CMO_EMAIL', 'cmo@lamoment.id'),
                'password_hash' => Hash::make(env('CMO_PASSWORD', 'DefaultPassword123!')),
                'role' => 'CMO',
                'status' => 'active',
            ]);
        }

        if (!User::where('email', 'coo@lamoment.id')->exists()) {
            User::create([
                'name' => env('COO_NAME', 'COO User'),
                'email' => env('COO_EMAIL', 'coo@lamoment.id'),
                'password_hash' => Hash::make(env('COO_PASSWORD', 'DefaultPassword123!')),
                'role' => 'COO',
                'status' => 'active',
            ]);
        }
        */
    }
}