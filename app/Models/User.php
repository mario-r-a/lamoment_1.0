<?php

namespace App\Models;

// ⚠️ PENTING: Jangan pakai 'use Illuminate\Database\Eloquent\Model;'
// Ganti dengan ini agar fitur Login berfungsi:
use Illuminate\Foundation\Auth\User as Authenticatable; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // ⚠️ Pastikan extends Authenticatable, BUKAN Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Set Primary Key sesuai ERD
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password_hash', // Nama kolom di database
        'role',
        'status',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password_hash' => 'hashed',
        ];
    }

    // Ketika ambil password user, ambil dari kolom 'password_hash', bukan 'password' biasa
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Ketika set 'password', kita ke 'password_hash'
    public function setAttribute($key, $value)
    {
        if ($key === 'password') {
            $key = 'password_hash';
        }
        return parent::setAttribute($key, $value);
    }

    // Override getAttribute untuk password
    public function getAttribute($key)
    {
        if ($key === 'password') {
            return $this->password_hash;
        }
        return parent::getAttribute($key);
    }
}