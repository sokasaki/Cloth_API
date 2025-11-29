<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // --- IGNORE ---
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'main_image',
        'front_image',
        'back_image',
        'side_image'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }
    public function additionalImages()
    {
        return $this->hasMany(ProductAdditionalImage::class);
    }
}