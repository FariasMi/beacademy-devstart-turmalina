@extends("template.default")
@section("title", "Lista de Usuários")
@section("main")


<div class="pt-6 grid mx-64">
    <div class="grid bg-slate-700 rounded-lg">
        <form action="{{ route('dashboard') }}" class="justify-self-start absolute bg-slate-100 rounded-lg mx-auto w-max ml-4 mt-2 mb-2">
            <input id="search" name="search" type="search" class="peer relative z-10 h-9 w-12 cursor-pointer rounded-lg border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:pl-16 focus:pr-4 focus:border-gray-500 focus:ring-0" />
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent stroke-green-500 px-3.5 peer-focus:border-green-400 peer-focus:stroke-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </form>
        <a href="{{ route( 'user.create') }}" class="btn-success mt-2 mb-2 mr-4 justify-self-end">Novo Usuário</a>
    </div>
    <table class="table-fixed border-separate border-spacing-y-3">
        <thead>
            <tr class="bg-white">
                <th class="p-4">#ID</th>
                <th class="p-4">Nome</th>
                <th class="p-4">Sobrenome</th>
                <th class="p-4">CPF</th>
                <th class="p-4">Telefone</th>
                <th class="p-4">Email</th>
                <th class="p-4">Cadastrado em</th>
                <th class="p-4">Atualizado em</th>
                <th class="p-4">Administrador</th>
                <th class="p-4">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            @include ("components.link-show")
            <td class="text-center">{{ $user->id }}</td>
            <td class="text-center">{{ $user->name }}</td>
            <td class="text-center">{{ $user->last_name }}</td>
            <td class="text-center">{{ $user->cpf }}</td>
            <td class="text-center">{{ $user->phone }}</td>
            <td class="text-center">{{ $user->email }}</td>
            <td class="text-center">{{ date("d/m/Y | H:i",strtotime($user->created_at)) }}</td>
            <td class="text-center">{{ date("d/m/Y | H:i", strtotime($user->updated_at)) }}</td>
            <td class="text-center">
                @if ($user->is_admin)
                <span class="text-green-500">Sim</span>
                @else
                <span class="text-red-500">Não</span>
                @endif
            </td>
            <td class="text-center p-3">
                @include("components.btn-edit")

                @include("components.btn-delete")
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    {{ $users->links('pagination::tailwind') }}

</div>
@endsection
