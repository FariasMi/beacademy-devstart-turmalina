@extends("template.default")
@section("title", "Home")
@section("main")

<div class="grid justify-items-center">
    <div class="pt-6 p-10 w-2/6">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @method("PUT")
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nome')" />

                <x-input id="name" value="{{ $user->name }}" class="block mt-1 w-full" type="text" name="name" />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="__('Sobrenome')" />

                <x-input id="last_name" value="{{ $user->last_name }}" class="block mt-1 w-full" type="text" name="last_name" />
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-label for="cpf" :value="__('CPF')" />

                <x-input id="cpf" value="{{ $user->cpf }}" class="block mt-1 w-full" type="text" name="cpf" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Telefone')" />

                <x-input id="phone" value="{{ $user->cpf }}" class="block mt-1 w-full" type="text" name="phone" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" value="{{ $user->email }}" class="block mt-1 w-full" type="email" name="email" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Senha')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Senha')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Editar Usuário') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection