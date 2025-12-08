<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /** @use HasFactory<\Database\Factories\FaqFactory> */
    use HasFactory;

    protected $primaryKey = 'faq_id';

    protected $fillable = [
        'faq_category_id',
        'question',
        'answer',
        'position',
        'is_active'
    ];

    // Relation ke FaqCategory (many-to-one)
    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}