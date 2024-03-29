@extends("template.default")
@section("title", "Lista de Produtos")
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

    <div class="grid bg-slate-700 rounded-lg">
        <form action="{{ route('search') }}" class="justify-self-start absolute bg-slate-100 rounded-lg mx-2.5 w-max ml-4 mt-2 mb-2">
            <input id="search" name="search" type="search" class="peer relative z-10 h-9 w-12 cursor-pointer rounded-lg border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:pl-16 focus:pr-4 focus:border-gray-500 focus:ring-0" />
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent stroke-green-500 px-3.5 peer-focus:border-green-400 peer-focus:stroke-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </form>
        <a href="{{ route( 'product.create') }}" class="btn-success mt-2 mb-2 mr-4 justify-self-end">Novo Produto</a>
    </div>

    <table class="table-fixed border-separate border-spacing-y-3">
        <thead>
            <tr class="bg-white shadow-lg rounded-md">
                <th class="p-4">#ID</th>
                <th class="p-4">Nome</th>
                <th class="p-4">Quantidade</th>
                <th class="p-4 hidden">Descrição</th>
                <th class="p-4">Categoria</th>
                <th class="p-4">Preço de Venda</th>
                <th class="p-4">Preço de Custo</th>
                <th class="p-4 hidden">Cadastrado</th>
                <th class="p-4 hidden">Atualizado</th>
                <th class="p-4">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr onclick="window.location='{{ route('products.show', $product->id) }}'" class="table-row shadow-lg rounded-md bg-white hover:bg-gray-300 cursor-pointer">
                <td class="text-center pr-4">{{ $product->id }}</td>
                <td class="text-center pr-4">{{ $product->name }}</td>
                <td class="text-center pr-4">{{ $product->quantity }}</td>
                <td class="text-center pr-4 hidden">{{ $product->description }}</td>
                <td class="text-center pr-4">{{ $product->category }}</td>
                <td class="text-center pr-4">{{ formatMoney($product->sale_price) }}</td>
                <td class="text-center pr-4">{{ formatMoney($product->price) }}</td>
                <td class="text-center pr-4 hidden">{{ date("d/m/Y | H:i",strtotime($product->created_at)) }}</td>
                <td class="text-center pr-4 hidden">{{ date("d/m/Y | H:i", strtotime($product->updated_at)) }}</td>
                <td class="text-center pr-4 p-3">
                    <a href="{{ route('product.edit', $product->id) }}" class="btn-alert mr-1">
                        Editar
                    </a>
                    <form action="{{ route('product.delete', $product->id) }}" method="POST" class="inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn-danger">
                            Deletar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-full grid justify-items-center mt-8">
        {{ $products->appends(Request::except('page'))->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
