<?php

namespace App\Http\Controllers;

use App\Mail\MailOrderPending;
use App\Mail\MailOrderSuccess;
use Illuminate\Http\Request;
use App\Models\{
    OrderProduct,
    Order,
    Product
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            session()->flash('success', 'Produto adicionado com sucesso!');
            return redirect()->route('cart.index');
        }
    }

    public function addProduct(Request $request)
    {
        $dataForm = $request->all();
        $product = $this->product->find($dataForm['id']);
        $user = auth()->user()->id;
        $orderId = $this->order->searchOrder([
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

    public function delete(Request $request)
    {
        $dataForm = $request->all();
        $removeItem = (boolean)$dataForm['item'];
        $user = auth()->user();
        $orders = $this->order->searchOrder([
            'user_id' => $user->id,
            'id' => $dataForm['pedido_id'],
            'status' => 'RE'
        ]);
        if(empty($orders)) {
            session()->flash('error','Pedido não encontrado!');
            return redirect()->route('cart.index');
        }
        $where_order = [
            'order_id' => $dataForm['order_id'],
            'product_id' => $dataForm['product_id']
        ];
        $product = $this->orderProduct->where($where_order)->orderBy('id', 'desc')->first();
        if(empty($product->id)) {
            session()->flash('error', 'Produto não encontrado!');
            return redirect()->route('cart.index');
        }
        if($removeItem) {
            $where_order['id'] =  $product->id;
        }
        $this->orderProduct->where($where_order)->delete();
        $checkOrder = $this->orderProduct->where([
            'order_id' => $product->order_id
        ])->exists();
        if(!$checkOrder) {
            $this->order->where([
                'id' => $product->order_id
            ])->delete();
        }
        session()->flash('success', 'Produto removido');
        return redirect()->route('cart.index');
    }

    public function final(Request $request)
    {
        $dataForm = $request->all();

        $user = auth()->user();
        $checkOrder = $this->order->where([
            'id' => $dataForm['order_id'],
            'user_id' => $user->id,
            'status' => 'RE'
        ]);

        if(!$checkOrder) {
            session()->flash('error', 'Produtos do pedido nao encontrados!');
            return redirect()->route('cart.index');
        }
        
        $order = Order::where('id', $dataForm['order_id'])->first();
        
        Mail::to(Auth::user()->email)->send(new MailOrderPending($order)); 
        
        return view('cart.payment', compact('order'));
    }

    public function showOrders()
    {
        $user = auth()->user()->id;
        $orders_made = $this->order->where([
            'user_id' => $user
        ])->orderBy('created_at', 'desc')->paginate(8);
        $ordersCancel = $this->order->where([])->orderBy('updated_at', 'desc')->get();
        return view('cart.orders', compact('orders_made', 'ordersCancel'));
    }

    public function delete_order($id, $order_id){
       OrderProduct::where('order_id', $order_id)->where('product_id', $id)->first()->delete();

       return redirect()->back()->with('warning', 'Produto removido');
    }
}