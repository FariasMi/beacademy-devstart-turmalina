@extends('template.default')
@section('title', 'Listagem de Produtos')
@section('main')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight hover:text-indigo-400 cursor-pointer">
            {{ __('Lista de Produtos') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <div class="pt-1 flex flex-col items-center">    
            <table class="table border-separate border-spacing-y-3">
                <thead>
                    <tr class="bg-white">
                        <th class="p-3">Nome</th>
                        <th class="p-3">Quantity</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">description</th>
                        <th class="p-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="bg-white hover:bg-gray-300">
                            <td class="text-center p-3">{{ $product->name }}</td>
                            <td class="text-center p-3">{{ $product->quantity }}</td>
                            <td class="text-center p-3">{{ $product->price }}</td>
                            <td class="text-center p-3">{{ $product->description }}</td>
                            <td class="text-center p-3">
                                <a href="" class="btn-alert mr-1">
                                    Editar
                                </a>
                                <a href="" class="btn-danger">
                                    Deletar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>


