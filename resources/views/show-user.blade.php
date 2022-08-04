@extends("template.default")
@section("title", "Informações de {$user->name}")
@section("main")

<div class="flex justify-center">
    <div class="bg-white shadow-lg flex justify-center rounded-lg w-4/6 p-4 my-8"><strong> {{ $user->name }} {{ $user->last_name }} </strong></div>
</div>

<div class="flex justify-center">

    @if (session()->has('success'))
    <div class="absolute grid justify-self-center top-20">
        <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                {{ session()->get('success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

    @if (session()->has('warning'))
    <div class="absolute grid justify-self-center top-20">
        <div id="alert-3" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                {{ session()->get('warning') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

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
            <h4 class="font-bold my-2">Atualizado em: <span class="font-medium">{{ date("d/m/Y | H:i", strtotime($user->updated_at)) }}</span></h4>
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
