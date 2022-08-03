@extends("template.default")
@section("title", "Carrinho")
@section("main")

<div class="grid justify-center ">
    <div class="">
        <div class="bg-slate-700 text-white shadow-lg flex justify-center rounded-lg p-4 mb-8"><strong> Meu Carrinho </strong></div>
    </div>

    @if ($orders->count() === 0)
    <div class="bg-white shadow-lg flex justify-center rounded-lg">
        <h1 class="font-bold py-4 text-indigo-500 px-96">Nenhum produto no carrinho!</h1>
    </div>
    @endif

    @foreach ($orders as $order)
    @php
    $amount = 0;
    @endphp
    <table class="table-fixed border-separate border-spacing-y-3">
        <thead>
            <tr class="shadow-lg rounded-md">
                <th class="px-20 py-4">#Código</th>
                <th class="px-20 py-4">Quantidade</th>
                <th class="px-20 py-4">Produto</th>
                <th class="px-20 py-4">Valor Unitário</th>
                <th class="px-20 py-4">Total</th>
        </thead>
        <tbody>
            @foreach ($order->order_products as $orderItem )
            @php
            $total_product = $orderItem->products->sale_price * $orderItem->qtd;
            $amount += $total_product;
            @endphp
            <tr onclick="window.location='{{ route('products.show', $orderItem->products->id) }}'" class="table-row shadow-lg rounded-md bg-white hover:bg-gray-300 cursor-pointer">

                <td class="text-center pr-4">{{ $orderItem->products->id }}</td>
                <td class="text-center pr-4">{{ $orderItem->qtd }}</td>
                <td class="text-center pr-4">{{ $orderItem->products->name }}</td>
                <td class="text-center pr-4">{{ formatMoney($orderItem->products->sale_price) }}</td>
                <td class="text-center pr-4">{{ formatMoney($total_product) }}</td>
                <td class="text-center p-3">
                    <form action="{{ route('cart.delete', ['id'=>$orderItem->products->id, 'order_id' => $order->id]) }}" method="POST" class="inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn-danger">
                            <span class="px-2">X</span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-full grid justify-items-center mt-8">
        {{-- {{ $users->appends(Request::except('page'))->links('vendor.pagination.tailwind') }} --}}
    </div>

    <div class="flex justify-center">
        <div class="bg-white shadow-lg relative flex justify-center rounded-lg w-full my-8">
            <div class="flex my-2 justify-center w-2/4">
                <a class="btn-success mr-1" href="{{ route('home.index') }}">Continuar Comprando</a>
                <form action="{{ route('cart.final') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <button class="btn-danger" type="submit">Concluir Compra</button>
                </form>
            </div>

            <div class="border-2-2 absolute h-full border border-gray-700 border-opacity-20"></div>

            <div class="mx-auto my-auto">
                Total do pedido: <span class="font-bold">{{ formatMoney($amount) }}</span>
            </div>
        </div>
    </div>

    @endforeach
</div>
@endsection
