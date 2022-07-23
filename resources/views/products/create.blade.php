@extends("template.default")
@section("title", "Home")
@section("main")

<div class="grid justify-items-center">
    <div class="pt-6 p-10 w-2/6">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('product.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nome')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="quantity" :value="__('Quantidade')" />

                <x-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" :value="old('quantity')" />
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-label for="description" :value="__('Descrição')" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="price" :value="__('Valor')" />

                <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" />
            </div>


            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Cadastrar Produto') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection