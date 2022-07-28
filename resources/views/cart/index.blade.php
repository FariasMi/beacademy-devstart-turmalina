@extends("template.default")
@section("title", "Home")
@section("main")

    <h1>carrinho de compras</h1>

    <strong>{{ $user->name }}</strong>
    @foreach($orders as $order)
        <h2>pedido: {{ $order->id }}</h2>

    @endforeach
@endsection
