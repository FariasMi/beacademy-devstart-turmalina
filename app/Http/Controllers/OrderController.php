<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    OrderProduct,
    Order,
    Product
};

class OrderController extends Controller
{
    protected $orderProduct;
    protected $order;
    protected $product;

    public function __construct(OrderProduct $orderProduct, Order $order, Product $product,)
    {
        $this->orderProduct = $orderProduct;
        $this->order = $order;
        $this->product = $product;
    }
    public function index()
    {
        $orders = $this->order
                        ->where([
                            'status' => 'RE',
                            'user_id' => auth()->user()->id
                        ])->get();
        return view('cart.index', compact('orders'));
    }

    public function show($id)
    {
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
        // dd($product);
        return view('cart.cart',compact('order', 'product'));
    }
    public function store(Request $request)
    {
        $dataForm = $request->all();
        $product = $this->product->find($dataForm['product_id']);
        $user = auth()->user()->id;

        $orderId = $this->order->searchOrder([
            'user_id' => $dataForm['user_id'],
            'status' => 'RE'
        ]);

        if(empty($orderId)) :
            $newOrder = $this->order->create([
                'user_id' => $dataForm['user_id'],
                'status' => 'RE'
            ]);

            $orderId = $newOrder->id;
        endif;

        $createOrderProduct = $this->orderProduct->create([
            'status' => 'RE',
            'price' => $product->sale_price,
            'product_id' => $product->id,
            'order_id' => $orderId
        ]);

        if($createOrderProduct){
            session()->flash('success', 'PRODUTO ADICIONANDO AO CARRINHO');
            return redirect()->route('cart.index');
        }
    }

    public function addProduct(Request $request)
    {
        $dataForm = $request->all();
        $product = $this->product->find($dataForm['id']);
        $user = auth()->user()->id;
        $orderId = $this->order-searchOrder([
            'user_id' => $user,
            'status' => 'Re'
        ]);

        if(empty($orderId)) {
            $newOrder = $this->order->create([
                'user_id' => $user,
                'status' => 'RE'
            ]);

            $orderId = $newOrder->id;
        }

        $createOrderProduct = $this->orderProduct->create([
            'status' => 'RE',
            'price' => $product->sale_price,
            'product_id' => $product->id,
            'order_id' => $orderId
        ]);
    }
}
