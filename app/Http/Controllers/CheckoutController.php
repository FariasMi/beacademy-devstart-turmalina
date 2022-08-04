<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use App\Models\{
    OrderProduct,
    Order,
    Product
};

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

    public function create(Request $request)
    {

        $order = $this->order->find($request->order_id);
        return view('site.checkout', compact('order'));
    }

    public function ticket(Request $request)
    {

        $dataForm = $request->all();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'token' => 'UGFyYWLDqW5zLCB2b2PDqiBlc3RhIGluZG8gYmVtIQ=='
        ])->post('https://tracktools.vercel.app/api/checkout', [
            'transaction_type' => $request->transaction_type,
            'transaction_amount' => (int)$request->transaction_amount,
            'transaction_installment' => (int)$request->transaction_installments,
            'customer_name' => $request->name,
            'customer_document' => $request->cpf,
            'customer_postcode' => $request->postcode,
            'customer_address_street' => $request->address,
            'customer_address_number' => $request->address_number,
            'customer_address_neighborhood' => $request->address_neighborhood,
            'customer_address_city' => $request->address_city,
            'customer_address_state' => $request->address_state,
            'customer_address_country' => $request->address_country
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
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('checkout.boleto-template', compact('request','data')));
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream();

        return redirect()->route('home.index')->with('donwload', 'Boleto gerado com sucesso!');
    }

    public function card(Request $request)
    {
        $dataForm = $request->all();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'token' => 'UGFyYWLDqW5zLCB2b2PDqiBlc3RhIGluZG8gYmVtIQ=='
        ])->post('https://tracktools.vercel.app/api/checkout', [
            'transaction_type' => $request->transaction_type,
            'transaction_amount' => (int)$request->transaction_amount,
            'transaction_installment' => (int)$request->transaction_installments,
            'customer_name' => $request->name,
            'customer_document' => $request->cpf,
            'customer_postcode' => $request->postcode,
            'customer_address_street' => $request->address,
            'customer_address_number' => $request->address_number,
            'customer_address_neighborhood' => $request->address_neighborhood,
            'customer_address_city' => $request->address_city,
            'customer_address_state' => $request->address_state,
            'customer_address_country' => $request->address_country
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
        }

        session()->flash('success', 'pagamento realizado com sucesso , Obrigado volte sempre!');
        return redirect()->route('home.index');

    }
}
