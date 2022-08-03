<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function __construct(Product $product){
        $this->model = $product;
    }

    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }
}