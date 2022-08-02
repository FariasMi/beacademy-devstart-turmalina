@extends("template.default")
@section("title", "Informações de {$user->name}")
@section("main")

<div class="flex justify-center">
    <div class="bg-white shadow-lg flex justify-center rounded-lg w-4/6 p-4 my-8"><strong> {{ $user->name }} {{ $user->last_name }} </strong></div>
</div>

<div class="flex justify-center">
    <div class="bg-white shadow-lg relative flex justify-center rounded-lg w-4/6">
        <div class="my-6 mx-auto">
            <h1 class="font-bold my-2 text-indigo-500">Dados:</h1>
            <h4 class="font-bold my-2">Nome: <span class="font-medium">{{ $user->name }}</span></h4>
            <h4 class="font-bold my-2">Sobrenome: <span class="font-medium">{{ $user->last_name }}</span></h4>
            <h4 class="font-bold my-2">Email: <span class="font-medium">{{ $user->email }}</span></h4>
            <h4 class="font-bold my-2">CPF: <span class="font-medium">{{ $user->cpf }}</span></h4>
            <h4 class="font-bold my-2">Telefone: <span class="font-medium">{{ $user->phone }}</span></h4>
            <h4 class="font-bold my-2">Data de Nascimento: <span class="font-medium">{{ date("d/m/Y ", strtotime($user->date_of_birth)) }}</span></h4>
            <h4 class="font-bold my-2">Cadastrado em: <span class="font-medium">{{ date("d/m/Y | H:i", strtotime($user->created_at)) }}</span></h4>
        </div>
        <div class="border-2-2 absolute h-full border border-gray-700 border-opacity-20"></div>
        <div class="my-6 mx-auto">
            @if($user->addresses->count() > 0)
            <h1 class="font-bold my-2 text-indigo-500">Endereços:</h1>
            @endif
            @foreach ($addresses as $address)
            <div class="flex justify-between items-center">
                <div class="mb-4 mr-10">
                    <h4 class="font-bold">Rua: <span class="font-medium">{{ $address->street }}</span></h4>
                    <h4 class="font-bold">Número: <span class="font-medium">{{ $address->number }}</span></h4>
                    <h4 class="font-bold">Complemento: <span class="font-medium">{{ $address->complement }}</span></h4>
                    <h4 class="font-bold">Bairro: <span class="font-medium">{{ $address->neighborhood }}</span></h4>
                    <h4 class="font-bold">Cidade: <span class="font-medium">{{ $address->city }}</span></h4>
                    <h4 class="font-bold">Estado: <span class="font-medium">{{ $address->state }}</span></h4>
                    <h4 class="font-bold">CEP: <span class="font-medium">{{ $address->zip_code }}</span></h4>
                </div>
                <form action="{{ route('address.delete', $address->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn-danger" type="submit">Excluir</button>
                </form>
            </div>

            @endforeach
        </div>
    </div>
</div>

<div class="flex justify-center">
    <div class="bg-white shadow-lg relative flex justify-center rounded-lg w-4/6 my-8">
        <div class="flex mx-auto my-2">
            @include("components.btn-edit")
            @if (Auth::user()->is_admin)
            @include("components.btn-delete")
            @endif
        </div>
        <div class="border-2-2 absolute h-full border border-gray-700 border-opacity-20"></div>
        <a href="{{ route('address.create', $user->id) }}" class="btn-success mx-auto my-2">Adicionar endereço</a>
    </div>
</div>

@endsection
