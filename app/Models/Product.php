<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'small_description',
        'description',
        'brand',
        'price',
        'quantity',
        'trending',
        'featured',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}