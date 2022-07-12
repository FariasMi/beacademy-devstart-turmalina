@php
    $title = ucwords($section);
@endphp

@extends('template.default')
@section('title', "{$section}")
@section('main')

<div class="flex justify-around mt-5 px-52 gap-10 flex-wrap">
    @for ($i = 0; $i < 8; $i++) 
        @include('components.card-store') 
    @endfor
</div>
@endsection