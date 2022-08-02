<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class StoreController extends Controller {
    public function __construct(Product $product){
        $this->model = $product;
    }
    
    public function index($section) {
        if ($section == 'todos'){
            $products = Product::paginate(8);     
        }else if ($section !== 'papelaria' && $section !== 'escritorio' && $section !== 'arte' && $section !== 'outros'){
    
            return redirect()->back();
        }else {
            $products = Product::where('category', $section)->paginate(8);
        }
        
        
        return view('store', compact('section', 'products'));
    }
}