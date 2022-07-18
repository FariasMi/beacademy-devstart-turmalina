<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProductFormRequest;


class ProductController extends Controller
{
    public function __construct(Product $product){
        $this->model = $product;
    }
    
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function create() 
    {
        return view('products.create');
    }
    
    public function store(StoreUpdateProductFormRequest $request)
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

    public function show($id)
    {
        if(!$product = $this -> model -> find($id))
            abort(404);

        return view('products.index', compact('product'));
    }

    public function edit($id)
    {
        if(!$product = $this -> model -> find($id))
            abort(404);

        return view('products.edit', compact('product'));
    }

    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        if(!$product = $this->model->find($id))
            return redirect()->route('product.index');

        $data = $request->only('name','quantity','price');

        $product->update($data);

        return redirect()->route('product.index');
    }

}
