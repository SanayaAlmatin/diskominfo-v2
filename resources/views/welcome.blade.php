@extends('layouts.app')

@section('title', 'Portal Resmi Diskominfo Tangerang Selatan')
@section('body_class', 'welcome-modern bg-[#F5F8FC] text-slate-900 selection:bg-[#F7D558] selection:text-[#044FA0]')

@push('styles')
    <style>
        .welcome-modern header {
            border-top-color: rgba(255, 255, 255, 0.16) !important;
            border-bottom-color: none !important;
            box-shadow: none !important;
        }

        /* Fix: glass panel picks up body's near-white background via backdrop-blur,
               making the navbar appear white. Override with a solid dark-blue tint. */
        .welcome-modern [data-site-header]>div:first-child {
            background: rgba(4, 79, 160, 0.45) !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }

        .city-pattern {
            background-color: #044FA0;
            background-image: url("data:image/svg+xml,%3Csvg width='180' height='180' viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='.13' stroke-width='1.5'%3E%3Cpath d='M18 42h40v34h38v42h46'/%3E%3Cpath d='M30 132h28V98h48V58h44'/%3E%3Cpath d='M90 18v34M132 76h30M18 86h30M84 136v26'/%3E%3Ccircle cx='58' cy='42' r='4' fill='%23F7D558' fill-opacity='.72' stroke='none'/%3E%3Ccircle cx='96' cy='76' r='4' fill='%23FFFFFF' fill-opacity='.45' stroke='none'/%3E%3Ccircle cx='132' cy='132' r='4' fill='%23F7D558' fill-opacity='.72' stroke='none'/%3E%3Ccircle cx='90' cy='18' r='3' fill='%23FFFFFF' fill-opacity='.45' stroke='none'/%3E%3C/g%3E%3Cg fill='%23FFFFFF' fill-opacity='.1'%3E%3Crect x='18' y='146' width='12' height='16' rx='1'/%3E%3Crect x='36' y='134' width='12' height='28' rx='1'/%3E%3Crect x='54' y='122' width='12' height='40' rx='1'/%3E%3Crect x='126' y='144' width='12' height='18' rx='1'/%3E%3Crect x='144' y='126' width='12' height='36' rx='1'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 200px 200px;
            animation: cityPatternDrift 36s linear infinite;
        }

        .service-mark {
            background-image: url("data:image/svg+xml,%3Csvg width='96' height='96' viewBox='0 0 96 96' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23044FA0' stroke-opacity='.16' stroke-width='2'%3E%3Cpath d='M16 48h18l10-18 16 36 8-18h12'/%3E%3Ccircle cx='48' cy='48' r='34'/%3E%3Ccircle cx='48' cy='48' r='18'/%3E%3C/g%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem bottom 1rem;
        }

        .welcome-reveal {
            opacity: 0;
            transform: translateY(18px);
            animation: welcomeReveal 0.75s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .welcome-fade {
            opacity: 0;
            animation: welcomeFade 0.7s ease forwards;
        }

        .welcome-delay-1 {
            animation-delay: 0.08s;
        }

        .welcome-delay-2 {
            animation-delay: 0.16s;
        }

        .welcome-delay-3 {
            animation-delay: 0.24s;
        }

        .welcome-delay-4 {
            animation-delay: 0.32s;
        }

        .welcome-delay-5 {
            animation-delay: 0.4s;
        }

        .welcome-signal-dot {
            position: relative;
            isolation: isolate;
        }

        .welcome-signal-dot::after {
            content: "";
            position: absolute;
            inset: -7px;
            z-index: -1;
            border: 1px solid rgba(247, 213, 88, 0.72);
            border-radius: 999px;
            animation: welcomeSignalPulse 1.9s ease-out infinite;
        }

        .welcome-network-panel {
            opacity: 0;
            animation: welcomeFade 0.7s ease 0.32s forwards, welcomeFloat 7s ease-in-out 1s infinite;
            will-change: transform;
        }

        .welcome-metric {
            animation: welcomeSoftFloat 6s ease-in-out infinite;
        }

        .welcome-metric:nth-child(2) {
            animation-delay: 0.7s;
        }

        .service-card {
            opacity: 0;
            animation: welcomeFade 0.65s ease forwards;
        }

        .service-card:nth-child(1) {
            animation-delay: 0.12s;
        }

        .service-card:nth-child(2) {
            animation-delay: 0.22s;
        }

        .service-card:nth-child(3) {
            animation-delay: 0.32s;
        }

        .service-card:nth-child(4) {
            animation-delay: 0.42s;
        }

        @keyframes welcomeReveal {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes welcomeFade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes cityPatternDrift {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 320px 180px;
            }
        }

        @keyframes welcomeSignalPulse {
            from {
                opacity: 0.72;
                transform: scale(0.82);
            }

            to {
                opacity: 0;
                transform: scale(1.9);
            }
        }

        @keyframes welcomeFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes welcomeSoftFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .city-pattern,
            .welcome-reveal,
            .welcome-fade,
            .welcome-signal-dot::after,
            .welcome-network-panel,
            .welcome-metric,
            .service-card {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
@endpush

@section('content')
    @include('landing-page.home.section1')
    @include('landing-page.home.section2')
    @include('landing-page.home.section3')
    @include('landing-page.home.section4')
    @include('landing-page.home.section5')
    @include('landing-page.home.section6')
@endsection
