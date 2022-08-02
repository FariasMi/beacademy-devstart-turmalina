<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller {
    public function __construct(Product $product){
        $this->model = $product;
    }
    
    public function index($section) {
        if ($section === 'papelaria'){
            $products = Product::where('category', 'papeis')->get();
        } else if ($section === 'cadernos'){
            $products = Product::where('category', 'escritorio')->get();
        } else if ($section === 'escrita'){
            $products = Product::where('category', 'escrita')->get();
        } else if ($section === 'outros'){
            $products = Product::where('category',"!=", 'papeis')->orWhere('category', '!=', 'escrita')->orWhere('category', '!=', 'escritorio')->get();
        } else {
            abort(404);
        }
        return view('store', compact('section', 'products'));
    }
}