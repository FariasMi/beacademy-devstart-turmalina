<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class=" bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            @yield("main")
        </main>

        <footer class="flex justify-center p-8 mt-8  border-2">
            <p> &copy;2022 turmalina todos os direitos reservados </p>
        </footer>
    </div>
</body>

</html>