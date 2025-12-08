<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $primaryKey = 'client_id';

    protected $fillable = [
        'name',
        'phone',
        'source',
        'notes',
        'status'
    ];

    // Relation ke Event (one-to-many)
    public function events()
    {
        return $this->hasMany(Event::class, 'client_id');
    }
}