<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status'
    ];

    public function order_products()
    {
        // $this->belongsToMany(OrderProduct::class);
        return $this->hasMany(OrderProduct::class)
                    ->select(\DB::raw('product_id, sum(price) as amount, count(1) as qtd '))
                    ->with('products')
                    ->groupBy('product_id')
                    ->orderBy('product_id', 'desc');
    }

    public function order_product_item()
    {
         return $this->hasMany(Product::class);
    }

    public function searchOrder($value)
    {
        $order = self::where($value)->first();
        return !empty($order->id)? $order->id : null;
    }

    public function products()
    {
        $this->belongsToMany(Product::class);
    }
}
