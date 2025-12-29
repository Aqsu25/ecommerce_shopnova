<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;
    protected $fillable = ['name', 'slug', 'image', 'price', 'stock_quantity', 'description', 'category_id', 'sub_category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }

    // product_rating
    public function rating()
    {
        return $this->hasMany(productRating::class);
    }
    public function Sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
