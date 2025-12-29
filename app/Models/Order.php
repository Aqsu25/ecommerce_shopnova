<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['address', 'phone_number', 'user_id', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }
    public function order_Status()
    {
        return $this->hasMany(Order_Status::class);
    }
}
