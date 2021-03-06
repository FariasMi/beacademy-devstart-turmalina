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
        'price'
    ];


    public function getProducts(string $search = null) {
        $products = $this->where(function ($query) use ($search) {
            if ($search) {
                $query->orWhere("name", "LIKE", "%{$search}%");
            }
        })->paginate(8);

        return $products;
    }
}
