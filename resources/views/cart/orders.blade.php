@extends("template.default")
@section("title", "Meus Pedidos")
@section("main")

<div class="justify-center grid">
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

    <table class="table-fixed border-separate border-spacing-y-3">
        <thead>
            <tr class="bg-white shadow-lg rounded-md">
                <th class="p-4">#Número do Pedido</th>
                <th class="p-4">Valor Total</th>
                <th class="p-4">Status do Pedido</th>
                <th class="p-4">Data do Pedido</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders_made as $order)
            <tr class="table-row shadow-lg rounded-md bg-white hover:bg-gray-300 cursor-pointer">
                <td class="text-center py-4 pr-4">{{$order->id}}</td>
                <td class="text-center pr-4">{{ formatMoney($order->order_products->first()->amount) }}</td>
                <td class="text-center pr-4">
                    @if ($order->status === 'PA')
                    <span class="text-green-500">Pagamento Confirmado</span>
                    @else
                    <span class="text-orange-500">Pagamento Pendente</span>
                    @endif
                </td>
                <td class="text-center pr-4">{{ date("d/m/Y | H:i", strtotime($order->created_at)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <div class="w-full grid justify-items-center mt-8">
        {{ $orders_made->appends(Request::except('page'))->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
