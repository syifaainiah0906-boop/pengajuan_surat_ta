<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-yellow-50">

    <!-- Wrapper -->
    <div class="flex flex-col min-h-screen">

        <!-- ✅ NAVBAR -->
        @include('components.navbar')

        <!-- ✅ CONTENT -->
        <main class="flex-1">
            @yield('content')
        </main>

    </div>

</body>
</html>