@extends("template.default")
@section("title", "orders")
@section("main")
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
              <strong>{{session()->get('success')}}</strong>
              <button  type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger d-flex align-items-center">
              <strong>{{session()->get('error')}}</strong>
              <button  type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
    </div>
    <div class="container">
        <h2 class="text-xl font-bold">Minhas compras</h2>
        <hr>
        <div class="container">
                <div class="card-body">
                    @foreach ($ordersFinalized as $order)
                        <div class="row mt-4 shadow-md shadow-indigo-500/20 p-4 rounded-md hover:scale-[1.005] hover:bg-cyan-50">
                            <div class="col-lg-6">
                                <h5 class="card-title">pedido : {{$order->id}}  </h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="card-title">Criado em : {{$order->created_at->format('d/m/Y H:i')}} </h5>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endSection
