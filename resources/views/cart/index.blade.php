@extends("template.default")
@section("title", "Carrinho")
@section("main")

    <h1 class="text-center font-bold text-xl">Carrinho</h1>
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
                    <strong>{{ $user->name }}</strong>
                    <h2>pedido: {{ $order->id }}</h2>
                </div>
            @endforeach
        </div>
    </div>
@endsection
