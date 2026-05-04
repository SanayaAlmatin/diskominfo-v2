<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Diskominfo Tangerang Selatan')</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .text-kominfo-blue { color: #044FA0; }
        .bg-kominfo-blue { background-color: #044FA0; }
        .border-kominfo-blue { border-color: #044FA0; }
        .text-kominfo-yellow { color: #F7D558; }
        .bg-kominfo-yellow { background-color: #F7D558; }
    </style>

    @stack('styles')
</head>
<body class="antialiased text-gray-800 min-h-screen flex flex-col relative overflow-x-hidden @yield('body_class')">

    <!-- Include Header -->
    @include('layouts.header')

    <!-- Main Content -->
    @yield('content')

    @stack('scripts')
</body>
</html>
