<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Status extends Model
{
    protected $fillable = ['status', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
