<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <title>@yield("title")</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/carroussel.css', 'resources/js/app.js', 'resources/js/carroussel.js'])
</head>
    <body class="font-sans antialiased">
        <div>
            @include('layouts.navigation')
            <!-- Page Heading -->
            <header class="bg-white shadow">
                    @yield("header")
            </header>
            <!-- Page Content -->
            <main class="bg-slate-50 pb-3">
                @yield("main")
            </main>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight hover:text-indigo-400 cursor-pointer">
                    {{ __('Lista de Usuários') }}
                </h2>
            </x-slot>
            <footer class="flex justify-center p-8 mt-8">
                <p> &copy;2022 turmalina todos os direitos reservados  </p>
            </footer>
        </div>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    </body>
</html>
