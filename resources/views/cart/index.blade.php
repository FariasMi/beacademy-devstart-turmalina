@extends("template.default")
@section("title", "orders")
@section("main")
    <div class="container">
        @if(session()->has('success'))

            <div class="alert alert-info">
              <strong>{{session()->get('success')}}</strong>
              <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

        @endif
        @if(session()->has('error'))

            <div class="alert alert-info">
              <strong>{{session()->get('error')}}</strong>
              <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

        @endif
    </div>

    <div class="container">
        <div class="card">
            <h5 class="card-header">Produtos do carrinho </h5>
            <div class="card-body">
            @forelse ($orders as $order)
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="card-title">order :  {{ $order->id}}</h5>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Criado em :  {{ $order->created_at->format('d/m/Y H:i')}}</h5>
                </div>
                </div>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Qtd</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Valor Unit.</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_order = 0;
                            @endphp

                            @php
                                $amount = 0;
                            @endphp
                            @foreach ($order->order_products as $orderItem )

                            <tr>
                                <th scope="row">
                                    <a href="#" onclick="carrinhoRemoverProduto({{$order->id}}, {{$orderItem->produto_id}}, 1)">
                                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                    </a>
                                        <span class="col-lg-4">{{ $orderItem->qtd }}</span>
                                    <a href="#" onclick="carrinhoAdicionarProduto({{$orderItem->produto_id}})">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </th>
                                <th>
                                    {{$orderItem->products->name}}
                                </th>
                                <th>
                                    R$:   {{number_format($orderItem->products->sale_price, 2, ',', '.')}}
                                </th>
                                @php
                                    $total_product = $orderItem->products->sale_price *  $orderItem->qtd;
                                    $amount  += $total_product;
                                @endphp
                                <th>
                                    R$:   {{number_format($total_product, 2, ',', '.')}}
                                </th>

                            </tr>

                        @endforeach


                            <!--
                            <-->
                        </tbody>
                    </table>
                    <hr>
                        <div class="">
                            <a class="btn-success" href="{{route('product.index')}}">Continuar comprando</a>
                        </div>
                        <div class="">
                        <form action="{{ route('cart.final') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <button class="btn-danger" type="submit">CONCLUIR COMPRAS</button>
                        </form>
                    </div>
                    <div class="jumbotron jumbotron-fluid col-lg-4">
                        <div class="container">
                            <h1 class="display-5">Total do pedido R$:   {{number_format($amount, 2, ',', '.')}}</h1>
                        </div>
                    </div>
                 </div>

            @empty
                <h5>Não há nenhum order no carrinho</h5>
            @endforelse

            </div>
        </div>
    </div>

@endSection
