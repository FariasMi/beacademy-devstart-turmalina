@extends("template.default")
@section("title", "Lista de Produtos")
@section("main")


<div class="container pt-6 grid">

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
            <tr class="bg-white shadow rounded-md">
                <th class="p-4">#ID</th>
                <th class="p-4">Nome</th>
                <th class="p-4">Quantidade</th>
                <th class="p-4">Descrição</th>
                <th class="p-4">Categoria</th>
                <th class="p-4">Preço de Venda</th>
                <th class="p-4">Preço de Custo</th>
                <th class="p-4">Cadastrado</th>
                <th class="p-4">Atualizado</th>
                <th class="p-4">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr onclick="window.location='{{ route('products.show', $product->id) }}'" class="table-row shadow rounded-md bg-white hover:bg-gray-300 cursor-pointer">
                <td class="text-center">{{ $product->id }}</td>
                <td class="text-center">{{ $product->name }}</td>
                <td class="text-center">{{ $product->quantity }}</td>
                <td class="text-center">{{ $product->description }}</td>
                <td class="text-center">{{ $product->category }}</td>
                <td class="text-center">{{ formatMoney($product->sale_price) }}</td>
                <td class="text-center">{{ formatMoney($product->price) }}</td>
                <td class="text-center">{{ date("d/m/Y | H:i",strtotime($product->created_at)) }}</td>
                <td class="text-center">{{ date("d/m/Y | H:i", strtotime($product->updated_at)) }}</td>
                <td class="text-center p-3">
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
</div>
@endsection
