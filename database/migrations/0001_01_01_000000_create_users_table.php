<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // 1. Ganti id() biasa menjadi id('user_id') sesuai ERD
            // Ini akan membuat kolom bernama 'user_id' yang auto-increment & primary key
            $table->id('user_id'); 

            $table->string('name');
            $table->string('email')->unique();
            
            // 2. Ubah 'password' jadi 'password_hash' sesuai ERD
            $table->string('password_hash'); 
            
            // 3. Tambahkan kolom baru sesuai ERD (Role & Status)
            $table->string('role', 50); 
            $table->string('status', 50)->default('active'); // Kasih default biar aman

            // 4. JANGAN HAPUS INI (Penting untuk Breeze/Laravel)
            $table->timestamp('email_verified_at')->nullable(); // Untuk verifikasi email
            $table->rememberToken(); // WAJIB ADA untuk fitur "Remember Me"
            $table->timestamps(); // created_at & updated_at
        });

        // Tabel Reset Password (JANGAN DIUBAH, biarkan default)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel Sessions (JANGAN DIUBAH, biarkan default)
        // Kolom 'user_id' di sini sudah otomatis cocok dengan 'user_id' di tabel users kita
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index(); 
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};