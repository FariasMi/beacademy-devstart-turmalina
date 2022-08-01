<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'price',
        'product_id',
        'order_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
