<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    /** @use HasFactory<\Database\Factories\FaqCategoryFactory> */
    use HasFactory;

    protected $primaryKey = 'faq_category_id';

    protected $fillable = [
        'name',
        'description',
        'position',
        'is_active'
    ];

    // Relation ke Faq (one-to-many)
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'faq_category_id');
    }
}