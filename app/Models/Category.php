<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'name',
        'slug',
    ];

    // One to Many Relationship
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
