@extends("template.default")
@section("title", "Home")
@section("main")

<div class="h-96 mt-5 bg-slate-400">

</div>

<div class="flex flex-wrap justify-around mt-20 mb-20 px-72 gap-10 ">
    @for ($i = 0; $i < 3; $i++) 
        @include('components.card-store') 
    @endfor
</div>

<div class="h-96 bg-slate-400">

</div>

<div class="flex flex-wrap justify-around mt-20 mb-20 px-72 gap-10 ">
    @for ($i = 0; $i < 3; $i++) 
        @include('components.card-store') 
    @endfor
</div>

@endsection