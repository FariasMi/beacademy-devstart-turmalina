@extends("template.default")
@section("main")


<div class="pt-6 grid mx-64">


    
    <table class="table-fixed border-separate border-spacing-y-3">
        <thead>
            <tr class="bg-white">
                <th class="p-4">#ID</th>
                <th class="p-4">Foto</th>
                <th class="p-4">Nome</th>
                <th class="p-4">Quantidade</th>
                <th class="p-4">Descrição</th>
                <th class="p-4">Valor</th>
                <th class="p-4">Cadastrado em</th>
                <th class="p-4">Atualizado em</th>
                <th class="p-4">Ações</th>

            </tr>
        </thead>
        <tbody>

            <td class="text-center">{{ $product->id }}</td>
            <td class="text-center">{{ $product->photo }}</td>
            <td class="text-center">{{ $product->name }}</td>
            <td class="text-center">{{ $product->quantity }}</td>
            <td class="text-center">{{ $product->description }}</td>
            <td class="text-center">{{ $product->price }}</td>
            <td class="text-center">{{ date("d/m/Y | H:i",strtotime($product->created_at)) }}</td>
            <td class="text-center">{{ date("d/m/Y | H:i", strtotime($product->updated_at)) }}</td>
            <td class="text-center">

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

        </tbody>
    </table>




</div>
@endsection