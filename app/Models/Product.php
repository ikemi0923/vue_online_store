<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'price', 'stock', 'description'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getFirstImageUrlAttribute()
    {
        $firstImage = $this->images()->first();
        if ($firstImage) {
            $url = Storage::url($firstImage->path);
            if (app()->environment('production')) {
                if (!Str::startsWith($url, '/laravel')) {
                    $url = '/laravel' . $url;
                }
            }
            return $url;
        }
        return asset('images/no-image.jpg');
    }
}
