<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hover:text-indigo-400 cursor-pointer">
            {{ __('Lista de Usuários') }}
        </h2>
    </x-slot>

    <div class="pt-6 flex flex-col items-center">
        <table class="table border-separate border-spacing-y-3">
            <thead>
                <tr class="bg-white">
                    <th class="p-3">Nome</th>
                    <th class="p-3">Sobrenome</th>
                    <th class="p-3">CPF</th>
                    <th class="p-3">Telefone</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Cadastrado em</th>
                    <th class="p-3">Atualizado em</th>
                    <th class="p-3">Administrador</th>
                    <th class="p-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="bg-white hover:bg-gray-300">
                    <td class="text-center p-3">{{ $user->name }}</td>
                    <td class="text-center p-3">{{ $user->last_name }}</td>
                    <td class="text-center p-3">{{ $user->cpf }}</td>
                    <td class="text-center p-3">{{ $user->phone }}</td>
                    <td class="text-center p-3">{{ $user->email }}</td>
                    <td class="text-center p-3">{{ date("d/m/Y | H:i",strtotime($user->created_at)) }}</td>
                    <td class="text-center p-3">{{ date("d/m/Y | H:i", strtotime($user->updated_at)) }}</td>
                    <td class="text-center p-3">
                        @if ($user->is_admin)
                        <span class="text-green-500">Sim</span>
                        @else
                        <span class="text-red-500">Não</span>
                        @endif
                    </td>
                    <td class="text-center p-3">
                        <a href="" class="btn-alert mr-1">
                            Editar
                        </a>
                        <a href="" class="btn-danger">
                            Deletar
                        </a>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>