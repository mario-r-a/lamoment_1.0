<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // 1. Kasih tau Laravel kalau Primary Key kita bukan 'id', tapi 'user_id'
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password_hash', // Sesuaikan nama kolom
        'role',
        'status',
    ];

    protected $hidden = [
        'password_hash', // Sembunyikan hash saat return API/Array
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // Casting password_hash agar di-hash otomatis (Laravel 11 style)
            'password_hash' => 'hashed', 
        ];
    }

    // 2. OVERRIDE: Kasih tau Laravel kalau password kita ada di kolom 'password_hash'
    // Tanpa fungsi ini, Login Breeze TIDAK AKAN JALAN.
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}