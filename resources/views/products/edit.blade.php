@extends("template.default")
@section("title", "Home")
@section("main")

<div class="grid justify-items-center">
    <div class="pt-6 p-10 w-2/6">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('product.update', $product->id) }}">
            @method("PUT")
            @csrf


            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" value="{{ $product->name }}" class="block mt-1 w-full" type="text" name="name" />
            </div>


            <div class="mt-4">
                <x-label for="quantity" :value="__('quantity')" />

                <x-input id="quantity" value="{{ $product->quantity }}" class="block mt-1 w-full" type="text" name="quantity" />
            </div>



            <div class="mt-4">
                <x-label for="description" :value="__('description')" />

                <x-input id="description" value="{{ $product->description }}" class="block mt-1 w-full" type="text" name="description" />
            </div>



            <div class="mt-4">
                <x-label for="price" :value="__('price')" />

                <x-input id="price" value="{{ $product->price }}" class="block mt-1 w-full" type="text" name="price" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <div class="flex items-center justify-between mt-4">

                    <x-button class="ml-4">
                        {{ __('Editar Produto') }}
                    </x-button>
                </div>
        </form>
    </div>
</div>
@endsection