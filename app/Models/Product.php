<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'gram',
        'category_id',
        'media',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Ensure media files are removed whenever a product is deleted via Eloquent.
     * (Controller or BaseController 'delete' will trigger this. DB CASCADE alone will not.)
     */
    protected static function booted()
    {
        static::deleting(function (Product $product) {
            if (!empty($product->media) && Storage::disk('public')->exists($product->media)) {
                Storage::disk('public')->delete($product->media);
            }
        });
    }
}
