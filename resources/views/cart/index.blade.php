@extends("template.default")
@section("title", "Pedidos")
@section("main")

    <h1 class="text-center font-bold text-xl">Usuarios com Pedidos</h1>
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
                    <a href="">
                        {{ $order->id}}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
