@extends("template.default")
@section("title", "Carrinho Show")
@section("main")

    <h1 class="text-center font-bold text-xl">Carrinho - </h1>
    <div class="flex  justify-center ">

        <div class="flex-col container ">

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

        </div>
    </div>
@endsection
