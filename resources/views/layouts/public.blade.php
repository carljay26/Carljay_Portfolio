<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portfolio')</title>
    <link rel="icon" href="{{ asset('images/portfoliologo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: { primary: '#256af4', 'background-light': '#f5f6f8', 'background-dark': '#101622' },
                        fontFamily: { display: ['Space Grotesk', 'sans-serif'] },
                    },
                },
            };
        </script>
    @endif
    <style>body { font-family: 'Space Grotesk', sans-serif; }</style>
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    {{-- Navigation --}}
    <header class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 px-4 py-4 sm:px-6 md:px-8 sticky top-0 bg-background-light/90 dark:bg-background-dark/90 backdrop-blur-md z-10">
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-primary">
            <img src="{{ asset('images/portfoliologo.png') }}" alt="Logo" class="h-8 w-8 rounded-full object-cover">
            <span class="text-lg font-bold text-slate-900 dark:text-slate-100">Portfolio</span>
        </a>
        <nav class="hidden md:flex items-center gap-6">
            <a href="{{ route('home') }}"     class="text-sm font-medium transition-colors {{ request()->routeIs('home')     ? 'text-primary' : 'text-slate-600 dark:text-slate-400 hover:text-primary' }}">Home</a>
            <a href="{{ route('about') }}"    class="text-sm font-medium transition-colors {{ request()->routeIs('about')    ? 'text-primary' : 'text-slate-600 dark:text-slate-400 hover:text-primary' }}">About</a>
            <a href="{{ route('projects') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('projects') ? 'text-primary' : 'text-slate-600 dark:text-slate-400 hover:text-primary' }}">Experience</a>
            <a href="{{ route('contact') }}"  class="text-sm font-medium transition-colors {{ request()->routeIs('contact')  ? 'text-primary' : 'text-slate-600 dark:text-slate-400 hover:text-primary' }}">Contact</a>
        </nav>
        <div class="flex items-center gap-2">
            <a href="{{ route('login') }}" class="flex items-center justify-center rounded-xl h-10 px-4 border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                Login
            </a>
            <a href="{{ route('contact') }}" class="flex items-center justify-center rounded-xl h-10 px-5 bg-primary text-white text-sm font-bold hover:-translate-y-0.5 transition-all shadow-lg shadow-primary/20">
                Hire Me
            </a>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-slate-200 dark:border-slate-800 px-4 sm:px-6 md:px-8 py-8 mt-auto">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                © {{ date('Y') }} {{ $profile?->full_name ?? 'Portfolio' }}. Built with precision.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('about') }}"    class="text-xs text-slate-500 dark:text-slate-400 hover:text-primary transition-colors">About</a>
                <a href="{{ route('projects') }}" class="text-xs text-slate-500 dark:text-slate-400 hover:text-primary transition-colors">Experience</a>
                <a href="{{ route('contact') }}"  class="text-xs text-slate-500 dark:text-slate-400 hover:text-primary transition-colors">Contact</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
