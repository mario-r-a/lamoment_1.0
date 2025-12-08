<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryUnit extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryUnitFactory> */
    use HasFactory;

    protected $primaryKey = 'unit_id';

    protected $fillable = [
        'inventory_item_id',
        'condition',
        'purchase_date',
        'purchase_price',
        'lifespan_months',
        'status'
    ];

    // Relation ke InventoryItem (many-to-one)
    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    // Relation ke EventChecklistItem (one-to-many)
    public function checklistItems()
    {
        return $this->hasMany(EventChecklistItem::class, 'inventory_unit_id');
    }
}