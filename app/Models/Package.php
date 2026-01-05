<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;

    protected $primaryKey = 'package_id';

    protected $fillable = [
        'name',
        'description',
        'base_price',
        'is_active',
        'image'
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

    // Helper: Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }
        return asset('images/packages/default-package.webp'); // fallback image
    }

    // Helper: Check if has image
    public function getHasImageAttribute()
    {
        return $this->image && Storage::disk('public')->exists($this->image);
    }
}