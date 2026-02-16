<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Surat' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50">
    <x-components.navbar /> 

    {{ $slot }}
    
</body>
</html>