<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $primaryKey = 'review_id';

    protected $fillable = [
        'name',
        'rating',
        'content',
        'date',
        'is_active'
    ];
}