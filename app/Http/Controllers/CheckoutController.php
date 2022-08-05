<?php

namespace App\Http\Controllers;

use App\Mail\MailOrderSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use App\Models\{
    Address,
    OrderProduct,
    Order,
    Product
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
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


    public function ticket(Request $request)
    {
        $address = Address::where('id', $request->address_id)->first();
        
        $dataForm = $request->except('address_id');
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'token' => 'UGFyYWLDqW5zLCB2b2PDqiBlc3RhIGluZG8gYmVtIQ=='
        ])->post('https://tracktools.vercel.app/api/checkout', [
            'transaction_type' => $request->transaction_type,
            'transaction_amount' => (int)$request->transaction_amount,
            'transaction_installment' => (int)$request->transaction_installments,
            'customer_name' => $request->name,
            'customer_document' => $request->cpf,
            'customer_postcode' => $address->zip_code,
            'customer_address_street' => $address->street,
            'customer_address_number' => $address->number,
            'customer_address_neighborhood' => $address->neighborhood,
            'customer_address_city' => $address->city,
            'customer_address_state' => $address->state,
            'customer_address_country' => $address->country
        ]);

        $data = $response->json();
        
        if($data['response']['code'] == 201){

            $this->orderProduct->where([
                'id' => $dataForm['order_id']
            ])->update([
                'status' => 'PA'
            ]);

            $this->order->where([
                'id' => $dataForm['order_id']
            ])->update([
                'status' => 'PA'
            ]);

            $order = Order::where('id', $dataForm['order_id'])->first();
            Mail::to(Auth::user()->email)->send(new MailOrderSuccess($order)); 
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('checkout.boleto-template', compact('request','data')));
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream();

        return redirect()->route('home.index')->with('success', 'Boleto gerado com sucesso!');
    }

    public function card(Request $request)
    {
        $address = Address::where('id', $request->address_id)->first();

        $dataForm = $request->except('address_id');
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'token' => 'UGFyYWLDqW5zLCB2b2PDqiBlc3RhIGluZG8gYmVtIQ=='
        ])->post('https://tracktools.vercel.app/api/checkout', [
            'transaction_type' => $request->transaction_type,
            'transaction_amount' => (int)$request->transaction_amount,
            'transaction_installments' => (int)$request->transaction_installments,
            'customer_name' => $request->name,
            'customer_document' => $request->cpf,
            "customer_card_number" => $request->card_number,
            "customer_card_expiration_date" => $request->expiration_date,
            "customer_card_cvv" => $request->cvv
        ]);

        $data = $response->json();

        if($data['response']['code'] == 201){

            $this->orderProduct->where([
                'id' => $dataForm['order_id']
            ])->update([
                'status' => 'PA'
            ]);

            $this->order->where([
                'id' => $dataForm['order_id']
            ])->update([
                'status' => 'PA'
            ]);

            $order = Order::where('id', $dataForm['order_id'])->first();
            Mail::to(Auth::user()->email)->send(new MailOrderSuccess($order)); 
        }
        

        session()->flash('success', 'pagamento realizado com sucesso , Obrigado!');
        return redirect()->route('home.index');

    }
}