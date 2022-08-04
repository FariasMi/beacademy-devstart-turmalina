@extends("template.default")
@section("title", "Efetuar Pagamento")
@section("main")

@php
$amount = $order->order_products->first()->amount;
@endphp
<div class="flex justify-center">
    <div class="bg-slate-700 text-white shadow-xl flex flex-col text-center rounded-lg w-4/6 p-4 mb-8">
        <strong>Efetuar Pagamento</strong>
        <div class="flex justify-center relative mt-2">
            <button onclick="showTicket()" class="hover:text-indigo-400 focus:text-indigo-400"> <strong>Boleto</strong> </button>
            <div class="relative mx-20 border-2-2 h-full border border-white border-opacity-20"></div>
            <button onclick="showCard()" class="hover:text-indigo-400 focus:text-indigo-400"> <strong>Cartão</strong> </button>
        </div>
    </div>
</div>


<div class="flex justify-center">
    <div class="bg-white shadow-lg relative flex justify-center rounded-lg w-4/6">

        <div id="paymentCard" style="display: none;" class="mx-auto">
            <h1 class="text-center py-5 bg-white"><strong>Cartão de Crédito</strong></h1>

            <form class="mt-4 w-3/6 mx-auto" action="{{ route('checkout.card')}}" method="POST">
                @csrf
                <input type="hidden">
                <div class="grid grid-cols-12 gap-y-6 gap-x-4">
                    <div class="col-span-full">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input value="{{ auth()->user()->email }}" type="email" id="email" name="email" autocomplete="email" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome no cartão</label>
                        <div class="mt-1">
                            <input value="{{ auth()->user()->name }} {{ auth()->user()->last_name }}" type="text" id="name" name="name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                        <div class="mt-1">
                            <input value="{{ auth()->user()->cpf }}" type="text" id="cpf" name="cpf" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="card-number" class="block text-sm font-medium text-gray-700">Número do Cartão</label>
                        <div class="mt-1">
                            <input type="text" id="card-number" name="card_number" autocomplete="cc-number" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>

                    <div class="col-span-8 sm:col-span-9">
                        <label for="expiration-date" class="block text-sm font-medium text-gray-700">Data de Vencimento (MM/YY)</label>
                        <div class="mt-1">
                            <input type="text" name="expiration_date" id="expiration-date" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>

                    <div class="col-span-4 sm:col-span-3">
                        <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                        <div class="mt-1">
                            <input type="text" name="cvv" id="cvv" autocomplete="csc" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>
                    <input type="hidden" name="transaction_type" value="card" />
                    <input type="hidden" name="order_id" value="{{ $order->id}}" />
                    <input type="hidden" name="transaction_amount" value="{{ $amount }}" />
                    <input type="hidden" name="transaction_installments" value="2" />
                </div>

                <button type="submit" class="w-full mt-6 bg-slate-600 border border-transparent rounded-md shadow-sm py-2 px-4 text-sm font-medium text-white hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-slate-500">Pagar R$ </button>

                <div class="flex justify-center mt-10 gap-20 mb-5">
                    <img src="https://i.ibb.co/Sy4pSgH/paylivre.png" alt="PayLivre" class="h-8 w-30 ">
                </div>
            </form>
        </div>

        <div id="paymentTicket" style="display: none;" class="mx-auto">
            <h1 class="text-center py-5 bg-white"><strong>Boleto Bancário</strong></h1>


            <form class="mt-4 w-full mx-auto" action="{{ route('checkout.ticket')}}" method="POST">
                @csrf
                <div class="grid grid-cols-12 gap-y-6 gap-x-4">

                    <div class="col-span-full">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                        <div class="mt-1">
                            <input value="{{ auth()->user()->name }} {{ auth()->user()->last_name }}" type="text" id="name" name="name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input value="{{ auth()->user()->email }}" type="email" id="email" name="email" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="document" class="block text-sm font-medium text-gray-700">CPF</label>
                        <div class="mt-1">
                            <input value="{{ auth()->user()->cpf }}" type="text" id="document" name="cpf" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                        <select onclick="increase({{ auth()->user()->addresses }})" id="foo" name="address_id" id="address_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>Selecione um endereço</option>
                            @foreach (auth()->user()->addresses as $address)
                            <option value="{{ $address->id }}">{{ $address->street }} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-span-full">
                        <label for="address" class="block text-sm font-medium text-gray-700">Rua</label>
                        <div class="mt-1">
                            <input id="address_street" value="" type="text" id="address" name="address" class="block w-full bg-slate-200 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled required>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="address_number" class="block text-sm font-medium text-gray-700">Número</label>
                        <div class="mt-1">
                            <input id="address_number" value="" type="text" name="address_number" id="address_number" class="block w-full bg-slate-200 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled required>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-6">
                        <label for="postcode" class="block text-sm font-medium text-gray-700">Cep</label>
                        <div class="mt-1">
                            <input id="postcode" value="" type="text" name="postcode" id="postcode" class="block w-full bg-slate-200 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled required>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="address_neighborhood" class="block text-sm font-medium text-gray-700">Bairro</label>
                        <div class="mt-1">
                            <input id="address_neighborhood" value="" type="text" name="address_neighborhood" id="address_neighborhood" class="block w-full bg-slate-200 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled required>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-6">
                        <label for="address_city" class="block text-sm font-medium text-gray-700">Cidade</label>
                        <div class="mt-1">
                            <input id="address_city" value="" type="text" name="address_city" id="address_city" class="block w-full bg-slate-200 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled required>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="address_state" class="block text-sm font-medium text-gray-700">Estado</label>
                        <div class="mt-1">
                            <input id="address_state" value="" type="text" name="address_state" id="address_state" class="block w-full bg-slate-200 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled required>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-6">
                        <label for="address_country" class="block text-sm font-medium text-gray-700">País</label>
                        <div class="mt-1">
                            <input id="address_country" value="" type="text" name="address_country" id="address_country" class="block w-full bg-slate-200 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled required>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="transaction_type" value="ticket" />
                <input type="hidden" name="order_id" value="{{ $order->id}}" />
                <input type="hidden" name="transaction_amount" value="{{ $amount }}" />
                <input type="hidden" name="transaction_installments" value="2" />

                <button type="submit" class="w-full mt-6 bg-slate-600 border border-transparent rounded-md shadow-sm py-2 px-4 text-sm font-medium text-white hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-slate-500">Gerar Boleto</button>

                <div class="flex justify-center mt-10 gap-20 mb-5">
                    <img src="https://i.ibb.co/Sy4pSgH/paylivre.png" alt="PayLivre" class="h-8 w-30 ">
                </div>
            </form>
        </div>

    </div>
</div>

<div class="flex justify-center">
    <div class="bg-white shadow-lg relative flex justify-center rounded-lg w-4/6 my-8">

        <div class="border-2-2 absolute h-full border border-gray-700 border-opacity-20"></div>

    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function showCard() {
        $('#paymentCard').removeAttr('style');
        $("#paymentTicket").hide();
    }

    function showTicket() {
        $('#paymentTicket').removeAttr('style');
        $("#paymentCard").hide();
    }

    function increase(address) {
        for (let i = 0; i < address.length; i++) {
            if ($("select#foo option:checked").val() == address[i].id) {
                $("#address_street").val(address[i].street);
                $("#address_number").val(address[i].number);
                $("#postcode").val(address[i].zip_code);
                $("#address_neighborhood").val(address[i].neighborhood);
                $("#address_city").val(address[i].city);
                $("#address_state").val(address[i].state);
                $("#address_country").val(address[i].country);
            }
        }
    }

</script>
