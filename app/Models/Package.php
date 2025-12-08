<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;

    protected $primaryKey = 'package_id';

    protected $fillable = [
        'name',
        'description',
        'base_price',
        'is_active'
    ];

    // Relation ke Event (one-to-many)
    public function events()
    {
        return $this->hasMany(Event::class, 'package_id');
    }

    // Relation ke PackageItem (one-to-many)
    public function items()
    {
        return $this->hasMany(PackageItem::class, 'package_id');
    }
}