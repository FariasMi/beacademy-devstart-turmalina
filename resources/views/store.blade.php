@php
$title = ucwords($section);
@endphp

@extends('template.default')
@section('title', "{$title}")
@section('main')

<div class="flex justify-center mt-5 px-52 gap-10 flex-wrap">
    @foreach($products as $product)
    @include('components.card-store') 
    @endforeach
</div>

@endsection
