<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model

{
    use Sluggable;
    protected $fillable = ['name', 'slug'];

   
    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
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
