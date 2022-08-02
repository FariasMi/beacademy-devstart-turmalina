@extends("template.default")
@section("title", "Adicionar Endereço")
@section("main")

<div class="grid justify-items-center">
    <div class="pt-6 p-10 w-2/6">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/address/create/{{ $id }}">
            @csrf

            <!-- Street -->
            <div>
                <x-label for="street" :value="__('Rua')" />

                <x-input id="street" class="block mt-1 w-full" type="text" name="street" />
            </div>

            <!-- Number -->
            <div>
                <x-label for="number" :value="__('Número')" />

                <x-input id="number" class="block mt-1 w-full" type="number" name="number" />
            </div>

            <!-- Complement -->
            <div>
                <x-label for="complement" :value="__('Complemento')" />

                <x-input id="complement" class="block mt-1 w-full" type="text" name="complement" />
            </div>

            <!-- Zip Code -->
            <div>
                <x-label for="zip_code" :value="__('CEP')" />

                <x-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" />
            </div>


            <!-- Neighborhood -->
            <div>
                <x-label for="neighborhood" :value="__('Bairro')" />

                <x-input id="neighborhood" class="block mt-1 w-full" type="text" name="neighborhood" />
            </div>

            <!-- City -->
            <div>
                <x-label for="city" :value="__('Cidade')" />

                <x-input id="city" class="block mt-1 w-full" type="text" name="city" />
            </div>

            <!-- State -->
            <div>
                <x-label for="state" :value="__('Estado')" />

                <x-input id="state" class="block mt-1 w-full" type="text" name="state" />
            </div>

            <!-- Country -->
            <div>
                <x-label for="country" :value="__('País')" />

                <x-input id="country" class="block mt-1 w-full" type="text" name="country" />
            </div>

            <div class="mt-4 flex justify-end">
                <x-button class="ml-4">
                    {{ __('Cadastrar Endereço') }}
                </x-button>
            </div>
    </div>
    </form>
</div>
</div>


@endsection
