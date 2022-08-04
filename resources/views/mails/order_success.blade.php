@php
$amount = 0;
@endphp
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <div class="grid justify-center">
            <h1>Obrigado por comprar conosco! 😄</h1>

            <h3 class="m-8">Número do pedido: {{ $pedido }}</h3>
            @foreach ($order->order_products as $product)
            @php
            $total_product = $product->products->sale_price * $product->qtd;
            $amount += $total_product;
            @endphp
            <div class="mb-2">
                <div class="w-full">
                    <img src="{{ $image_url . $product->products->photo }}" alt="{{ $product->products->name }}" class="w-48">
                </div>

                <h4>Produto: <strong>{{ $product->products->name }}</strong></h4>
                <h4>Quantidade: <strong>{{ $product->qtd }}</strong></h4>
                <h4>Preço: <strong>{{ formatMoney($product->products->sale_price) }}</strong></h4>
            </div>
            @endforeach

            <h2>Total: <strong>{{ formatMoney($amount) }}</strong></h2>
        </div>
    </x-auth-card>
</x-guest-layout>
