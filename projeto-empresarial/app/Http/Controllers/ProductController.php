<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function __construct(Product $product){
        $this->model = $product;
    }
    
    public function index()
    {
        $products = Product::all();

        return view('products.show', compact('products'));
    }



    public function create() 
    {
        return view('products.create');
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        
        $this->model->create($data);

        return redirect()->route('product.index');
    }

    public function search(Request $request) {

        $products = $this->model->getProducts(
            $request->search ?? ""
        );

        return view('products.show', compact('products'));
    }

}
