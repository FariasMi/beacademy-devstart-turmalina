<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProductFormRequest;
use Illuminate\Support\Facades\Storage;
use Spatie\FlareClient\View;


class ProductController extends Controller
{
    public function __construct(Product $product){
        $this->model = $product;
    }

    public function index()
    {
        $products = Product::paginate(8);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreUpdateProductFormRequest $request)
    {
        $data = $request->all();

        $value = $request['price'];
        $price = str_replace(',','.',$value);

        $data['price'] = $price;
        
        $value = $request['sale_price'];
        $sale_price = str_replace(',','.',$value);

        $data['sale_price'] = $sale_price;

        if($request->photo){
            $file = $request['photo'];
            $path = $file->store('products', 'public');
            $data['photo']= $path;
            Storage::disk('s3')->put($data['photo'], file_get_contents($request->photo));
        }
        
        $this->model->create($data);

        return redirect()->route('product.index')->with('success', "{$request->name} adicionado com sucesso!");
    }

    public function search(Request $request) {

        $products = $this->model->getProducts(
            $request->search ?? ""
        );

        return View('products.index', compact('products'));
    }

    public function show($id)
    {
        if(!$product = $this -> model -> find($id))
            abort(404);

        $user = auth()->user();
        return view('products.show', compact('product','user'));
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

        $data = $request->all();
        
        if($request->photo){
            $file = $request['photo'];
            $path = $file->store('products', 'public');
            $data['photo']= $path;
            Storage::disk('s3')->put($data['photo'], file_get_contents($request->photo));

        }
        
        $product->update($data);

        return redirect()->route('product.index')->with('success', "{$request->name} atualizado com sucesso!");
    }

    public function destroy($id)
    {
        if(!$products = $this->model->find($id))
        return redirect()->route('product.index');
        
        Storage::disk("s3")->delete($products->photo);
        $products->delete();

        return redirect()->route('product.index')->with('success', "Produto excluído com sucesso!");
    }

}