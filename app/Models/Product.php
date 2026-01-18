<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'category_id',
        'title',
        'price',
        'is_active',
    ];

    // One to Many Relationship
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
