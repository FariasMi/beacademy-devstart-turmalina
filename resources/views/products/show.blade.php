@extends("template.default")
@section("title", "{$product->name}")
@section("main")

@php
if (Auth::user()->is_admin){
$parameter = "";
$sale = "Valor de Venda:";
} else {
$parameter = "hidden";
$sale = "Valor:";
}

$url = config('app.env') === 'production' ? "https://turmalina-devstart.s3.amazonaws.com/" . $product->photo : URL::to('/storage/' . $product->photo);;

@endphp

<div class="grid mx-64">

    <div class="flex justify-center">
        <div class="bg-white shadow-lg flex justify-center rounded-lg w-full p-4 my-8"><strong> {{ $product->name }} </strong></div>
    </div>

    <div class="flex justify-center">
        <div class="bg-white shadow-lg relative flex justify-center rounded-lg w-full">
            <div class="my-6 mx-auto relative max-w-sm">
                <h1 class="font-bold my-2 text-indigo-500 text-center">{{$product->name}}</h1>
                <img src="{{ $url }}">

            </div>
            <div class="border-2-2 absolute h-full border border-gray-700 border-opacity-20"></div>
            <div class="my-6 mx-auto">
                <h4 class="font-bold my-2">Nome: <span class="font-medium">{{ $product->name }}</span></h4>
                <h4 class="font-bold my-2 {{ $parameter }}">Quantidade: <span class="font-medium">{{ $product->quantity }}</span></h4>
                <h4 class="font-bold my-2 {{ $parameter }}">Valor de Compra: <span class="font-medium">{{ formatMoney($product->price)  }}</span></h4>
                <h4 class="font-bold my-2"> {{ $sale }} <span class="font-medium">{{ formatMoney($product->sale_price)  }}</span></h4>
                <h4 class="font-bold my-2 {{ $parameter }}">Cadastrado em: <span class="font-medium">{{ date("d/m/Y | H:i", strtotime($product->created_at)) }}</span></h4>
                <h4 class="font-bold my-2 {{ $parameter }}">Atualizado em: <span class="font-medium">{{ date("d/m/Y | H:i", strtotime($product->updated_at)) }}</span></h4>
                <h4 class="font-bold my-2">Descrição: <span class="font-medium">{{ $product->description }}</span></h4>
            </div>

        </div>
    </div>

    <div class="flex justify-center">
        <div class="bg-white shadow-lg relative flex justify-center rounded-lg w-full my-8">
            <div class="flex mx-auto my-2">
                @if (Auth::user()->is_admin)
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
            </div>

            <div class="border-2-2 absolute h-full border border-gray-700 border-opacity-20"></div>
            @endif
            <div class="mx-auto">
                <form action="{{route('cart.store')}}" method="post">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn-success my-2" type="submit">Adicionar ao carrinho</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
