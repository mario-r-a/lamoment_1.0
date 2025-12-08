<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryItemFactory> */
    use HasFactory;

    protected $primaryKey = 'inventory_item_id';

    protected $fillable = [
        'name',
        'picture'
    ];

    // Relation ke InventoryUnit (one-to-many)
    public function units()
    {
        return $this->hasMany(InventoryUnit::class, 'inventory_item_id');
    }

    // Relation ke PackageItem (one-to-many)
    public function packageItems()
    {
        return $this->hasMany(PackageItem::class, 'inventory_item_id');
    }
}