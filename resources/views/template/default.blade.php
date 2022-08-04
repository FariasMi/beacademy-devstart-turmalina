<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />
    <title>@yield("title")</title>
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div>
        @include('layouts.navigation')
        <!-- Page Heading -->
        <header class="bg-white shadow">
            @yield("header")
        </header>
        <!-- Page Content -->
        <main class="pb-3">
            @yield("main")
        </main>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight hover:text-indigo-400 cursor-pointer">
                {{ __('Lista de Usuários') }}
            </h2>
        </x-slot>
        <footer class="flex justify-center p-8 mt-8 relative ">
            <p class=" bottom-0"> &copy;2022 turmalina todos os direitos reservados </p>
        </footer>
    </div>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> --}}
</body>
</html>
