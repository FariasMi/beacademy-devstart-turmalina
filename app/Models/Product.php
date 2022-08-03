<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'description',
        'category',
        'price',
        'sale_price',
        'photo'
    ];


    public function getProducts(string $search = null) {
        $products = $this->where(function ($query) use ($search) {
            if ($search) {
                $query->Where("name", "LIKE", "%{$search}%");
            }
        })->paginate(8);

        return $products;
    }

    public function order()
    {
        $this->belongsToMany(Order::class);
    }

    public function orderProduct()
    {
        $this->belongsToMany(OrderProduct::class);
    }

    public function user()
    {
        $this->belongsToMany(User::class);
    }

}