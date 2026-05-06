<!DOCTYPE html>
<html lang="id">

<head>
    @php
        $siteTitle = trim($__env->yieldContent('title', $title ?? 'Diskominfo Tangerang Selatan'));
        $siteDescription = trim(
            $__env->yieldContent(
                'meta_description',
                $metaDescription ??
                    'Portal resmi Dinas Komunikasi dan Informatika Kota Tangerang Selatan untuk informasi publik, layanan digital, data, dan infrastruktur teknologi informasi.',
            ),
        );
        $siteKeywords = trim(
            $__env->yieldContent(
                'meta_keywords',
                $metaKeywords ??
                    'Diskominfo Tangerang Selatan, Kominfo Tangsel, Pemerintah Kota Tangerang Selatan, layanan digital, informasi publik, smart city, satu data',
            ),
        );
        $siteRobots = trim($__env->yieldContent('meta_robots', $metaRobots ?? 'index, follow'));
        $siteUrl = url()->current();
        $siteImage = asset('Images/logo-kominfo.png');
    @endphp

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $siteDescription }}">
    <meta name="keywords" content="{{ $siteKeywords }}">
    <meta name="author" content="Dinas Komunikasi dan Informatika Kota Tangerang Selatan">
    <meta name="robots" content="{{ $siteRobots }}">
    <meta name="theme-color" content="#044FA0">
    <meta name="application-name" content="Portal Diskominfo Tangerang Selatan">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Portal Diskominfo Tangerang Selatan">
    <meta property="og:title" content="{{ $siteTitle }}">
    <meta property="og:description" content="{{ $siteDescription }}">
    <meta property="og:url" content="{{ $siteUrl }}">
    <meta property="og:image" content="{{ $siteImage }}">
    <meta property="og:image:alt" content="Logo Diskominfo Kota Tangerang Selatan">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $siteTitle }}">
    <meta name="twitter:description" content="{{ $siteDescription }}">
    <meta name="twitter:image" content="{{ $siteImage }}">

    <link rel="canonical" href="{{ $siteUrl }}">
    <link rel="icon" type="image/png" href="{{ $siteImage }}">
    <link rel="shortcut icon" type="image/png" href="{{ $siteImage }}">
    <link rel="apple-touch-icon" href="{{ $siteImage }}">

    <title>{{ $siteTitle }}</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4" data-navigate-once></script>

    <!-- Vite: JS bundle (includes Alpine component registrations) -->
    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .text-kominfo-blue {
            color: #044FA0;
        }

        .bg-kominfo-blue {
            background-color: #044FA0;
        }

        .border-kominfo-blue {
            border-color: #044FA0;
        }

        .text-kominfo-yellow {
            color: #F7D558;
        }

        .bg-kominfo-yellow {
            background-color: #F7D558;
        }
    </style>

    @livewireStyles

    @stack('styles')
</head>

<body
    class="antialiased text-gray-800 min-h-screen flex flex-col relative overflow-x-hidden {{ $bodyClass ?? '' }} @yield('body_class')">

    <!-- Include Header -->
    @include('layouts.header')

    <!-- Main Content -->
    @yield('content')

    @livewireScripts

    @stack('scripts')
</body>

</html>
