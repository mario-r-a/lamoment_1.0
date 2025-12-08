<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    /** @use HasFactory<\Database\Factories\PackageItemFactory> */
    use HasFactory;

    protected $primaryKey = 'package_item_id';

    protected $fillable = [
        'package_id',
        'inventory_item_id',
        'name',
        'quantity',
        'description'
    ];

    // Relation ke Package (many-to-one)
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    // Relation ke InventoryItem (many-to-one)
    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }
}