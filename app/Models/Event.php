<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'client_id',
        'event_type',
        'actual_date',
        'location',
        'package_id',
        'status',
        'notes'
    ];

    // Relation ke Client (many-to-one)
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Relation ke Package (many-to-one)
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    // Relation ke EventChecklist (one-to-many)
    public function checklists()
    {
        return $this->hasMany(EventChecklist::class, 'event_id');
    }
}