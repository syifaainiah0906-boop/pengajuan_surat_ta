<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="d-flex flex-column min-vh-100">
            @include('components.navbar')
        
            <div>
                @yield('content')
            </div>

        </div>
        
    </body>
</html>