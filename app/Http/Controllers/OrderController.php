<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class OrderController extends Controller
{
    protected $user;
    protected $order;

    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }
    public function index()
    {
        if(!$user = $this->user->find(2)){
            return redirect('/');
        }
        $orders = $user->orders()->get();
        return view('cart.index', compact('user','orders'));
    }


}
