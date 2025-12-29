<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productRating extends Model
{

    protected $table = 'product_rating';
    protected $fillable = ['user_id', 'product_id', 'comment', 'rating', 'status'];

    // user_rating
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // product_rating
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
