<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventChecklistItem extends Model
{
    /** @use HasFactory<\Database\Factories\EventChecklistItemFactory> */
    use HasFactory;

    protected $primaryKey = 'event_checklist_item_id';

    protected $fillable = [
        'event_checklist_id',
        'inventory_unit_id',
        'condition',
        'notes'
    ];

    // Relation ke EventChecklist (many-to-one)
    public function checklist()
    {
        return $this->belongsTo(EventChecklist::class, 'event_checklist_id');
    }

    // Relation ke InventoryUnit (many-to-one)
    public function unit()
    {
        return $this->belongsTo(InventoryUnit::class, 'inventory_unit_id');
    }
}