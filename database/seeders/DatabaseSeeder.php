<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@lamoment.id');
        $adminName = env('ADMIN_NAME', 'La Moment Admin');
        $adminPassword = env('ADMIN_PASSWORD', 'DefaultPassword123!');

        // ✅ CHECK: Apakah user CEO sudah ada?
        $ceoUser = User::where('email', $adminEmail)->first();
        
        if ($ceoUser) {
            // User sudah ada - UPDATE password & details
            $ceoUser->update([
                'name' => $adminName,
                'password_hash' => Hash::make($adminPassword),
                'role' => 'CEO',
                'status' => 'active',
            ]);
            
            echo "CEO user updated successfully! (Email: {$adminEmail})\n";
        } else {
            // User belum ada - CREATE new user
            User::create([
                'name' => $adminName,
                'email' => $adminEmail,
                'password_hash' => Hash::make($adminPassword),
                'role' => 'CEO',
                'status' => 'active',
            ]);

            echo "CEO user created successfully! (Email: {$adminEmail})\n";
        }

        // ✅ CALL DEMO DATA SEEDER
        $this->call(DemoDataSeeder::class);

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