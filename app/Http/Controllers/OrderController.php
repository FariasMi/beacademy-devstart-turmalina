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

        if($createOrderProduct){
            session()->flash('success', 'PRODUTO ADICIONADO AO CARRINHO');
            return redirect()->route('cart.index');
        }
    }

    public function delete(Request $request)
    {
        $dataForm = $request->all();
        $removeItem = (boolean)$dataForm['item'];
        $user = auth()->user();
        $order = $this->order->searchOrder([
            'user_id' => $user->id,
            'id' => $dataForm['pedido_id'],
            'status' => 'RE'
        ]);
        if(empty($order)) {
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

    public function finaly(Request $request)
    {
        $dataForm = $request->all();
        $user = auth()->user()->id;
        $checkOrder = $this->order->where([
            'id' => $dataForm['order_id'],
            'user_id' => $user,
            'status' => 'RE'
        ]);

        if(!$checkOrder) {
            session()->flash('error', 'Produtos do pedido nao encontrados!');
            return redirect()->route('cart.index');
        }

        $this->orderProduct->where([
            'id' => $dataForm['order_id']
        ])->update([
            'status' => 'PA'
        ]);

        $this->pedido->where([
            'id' => $dataForm['pedido_id']
        ])-update([
            'status' => 'PA'
        ]);

        session()->flash('success', 'pagamento realizado com sucesso , Obrigado volte sempre!');
        return redirect()->route('compras');
    }

    public function showOrders()
    {
        $user = auth()->user()->id;
        $ordersFinalized = $this->order->where([
            'status' => 'PA',
            'user_id' => $user
        ])->orderBy('create_at', 'desc')->get();
        $ordersCancel = $this->order->where([])->orderBy('updated_at', 'desc')->get();

        return view('painel.carrinho.compras', compact('ordersFinalized', 'ordersCancel'));
    }
}
