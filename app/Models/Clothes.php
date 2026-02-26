<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'price', 
        'stock', 
        'category_id', 
        'description', 
        'image_url',
        'size',
        'color',
        'condition'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke OrderDetail
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getImageSrcAttribute()
    {
        if (!$this->image_url) {
            return asset('images/placeholder.png');
        }

        if (\Illuminate\Support\Str::startsWith($this->image_url, 'http')) {
            return $this->image_url;
        }

        if (\Illuminate\Support\Str::startsWith($this->image_url, 'storage/')) {
            return asset($this->image_url);
        }

        // Cek jika path dimulai dengan '/'
        if (\Illuminate\Support\Str::startsWith($this->image_url, '/')) {
             // Cek jika path dimulai dengan '/storage/'
             if (\Illuminate\Support\Str::startsWith($this->image_url, '/storage/')) {
                return asset(substr($this->image_url, 1));
             }
             return asset('storage' . $this->image_url);
        }

        return asset('storage/' . $this->image_url);
    }
}
