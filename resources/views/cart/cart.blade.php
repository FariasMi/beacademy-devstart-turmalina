@extends("template.default")
@section("title", "Carrinho Show")
@section("main")

    <h1 class="text-center font-bold text-xl">Carrinho - {{ $order->id}}</h1>
    <div class="flex  justify-center ">

        <div class="flex-col container ">

                <div class="

                    shadow-md
                    shadow-cyan-500/50
                    rounded-md
                    p-3 mt-3
                    text-center
                    flex
                    justify-center

                ">
                    <table class="w-[100%] justify-center">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                                <td class="flex justify-center">
                                    <img width="30" src="{{ 'http://localhost:8000/storage/'.$product->photo }}" alt="">
                                </td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td> -------- </td>
                        </tbody>
                    </table>

                </div>

        </div>
    </div>
@endsection
