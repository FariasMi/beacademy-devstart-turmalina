@extends("template.default")
@section("title", "Carrinho Show")
@section("main")

    <h1 class="text-center font-bold text-xl">Carrinho - {{$user->name}}</h1>
    <div class="flex  justify-center ">

        <div class="flex-col container ">
            @foreach($orders as $order)
                <div class="
                    container
                    shadow-md
                    shadow-cyan-500/50
                    rounded-md
                    p-3 mt-3
                    text-center
                ">
                    <p>pedido: {{ $order->id}}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
