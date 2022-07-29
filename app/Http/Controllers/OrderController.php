<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Order,
    Product
};

class OrderController extends Controller
{
    protected $user;
    protected $order;
    protected $product;

    public function __construct(User $user, Order $order, Product $product,)
    {
        $this->user = $user;
        $this->order = $order;
        $this->product = $product;
    }
    public function index()
    {
        $users = $this->user->all();
        $orders = $this->order->all();
        return view('cart.index', compact('orders','users'));
    }

    public function show($id)
    {
        // $products = $this->product->all(
            // 'id',
            // 'name',
            // 'sale_price',
        // );
        if(!$user = $this->user->find($id)){
            return redirect('/');
        }

        $orders = $user->orders()->get();
        return view('cart.show', compact('user','orders'));
    }

    public function cart($id)
    {
        $order = $this->order->find($id);
        // dd($order);
        $product = $this->product->find($order->product_id);
        return view('cart.cart',compact('order', 'product'));
    }
    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     $this->model->create($data);
    //     return redirect('/cart');
    // }
}
