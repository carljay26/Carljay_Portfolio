<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portfolio - Admin')</title>
    <link rel="icon" href="{{ asset('images/portfoliologo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL@24,400,0&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Space Grotesk', sans-serif; overflow-x: hidden; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1; }
        @media (max-width: 767px) {
            .admin-sidebar.open { transform: translateX(0); }
            .admin-sidebar:not(.open) { transform: translateX(-100%); }
        }
    </style>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display min-h-screen overflow-x-hidden">
    <div class="flex min-h-screen w-full min-w-0">
        @include('admin.partials.sidebar')
        <main class="flex-1 flex flex-col min-w-0 bg-background-light dark:bg-background-dark w-full lg:ml-64">
            @unless (View::hasSection('admin_hide_header'))
                @include('admin.partials.header')
            @endunless
            <div class="p-3 sm:p-4 md:p-5 flex flex-col gap-4 md:gap-5 w-full max-w-none">
                @yield('content')
            </div>
        </main>
        <div id="admin-sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden" aria-hidden="true"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.getElementById('admin-sidebar');
            var overlay = document.getElementById('admin-sidebar-overlay');
            var toggle = document.getElementById('admin-sidebar-toggle');
            function openSidebar() { if (sidebar) sidebar.classList.add('open'); if (overlay) overlay.classList.remove('hidden'); }
            function closeSidebar() { if (sidebar) sidebar.classList.remove('open'); if (overlay) overlay.classList.add('hidden'); }
            if (toggle) toggle.addEventListener('click', function() { sidebar && sidebar.classList.contains('open') ? closeSidebar() : openSidebar(); });
            if (overlay) overlay.addEventListener('click', closeSidebar);
        });
    </script>
    @stack('scripts')
</body>
</html>
