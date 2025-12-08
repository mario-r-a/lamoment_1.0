<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventChecklist extends Model
{
    /** @use HasFactory<\Database\Factories\EventChecklistFactory> */
    use HasFactory;

    protected $primaryKey = 'event_checklist_id';

    protected $fillable = [
        'event_id',
        'checked_by_user_id',
        'type',
        'checked_at',
        'notes'
    ];

    // Relation ke Event (many-to-one)
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Relation ke User (many-to-one)
    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by_user_id');
    }

    // Relation ke EventChecklistItem (one-to-many)
    public function items()
    {
        return $this->hasMany(EventChecklistItem::class, 'event_checklist_id');
    }
}