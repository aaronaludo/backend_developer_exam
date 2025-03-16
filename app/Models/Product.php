<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'date_and_time'];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
