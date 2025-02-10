<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'description'];

    public function image(): HasOne
    {
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function getFirstImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image->path) : asset('images/no-image.png');
    }
}
