@extends("template.default")
@section("title", "Carrinho")
@section("main")

<div class="grid justify-center ">

    @if (session()->has('success'))
    <div class="absolute grid justify-self-center top-20">
        <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                {{ session()->get('success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

    @if (session()->has('warning'))
    <div class="absolute grid justify-self-center top-20">
        <div id="alert-3" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                {{ session()->get('warning') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

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

                @if (auth()->user()->addresses->count())
                <form action="{{ route('cart.payment') }}" method="POST">
                    @else
                    <form action="{{ route('user.show', ["id"=>auth()->user()->id, "address_empty"=>1]) }}">
                        @endif
                        @csrf
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <button class="btn-danger" type="submit">Confirmar Pedido</button>
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
