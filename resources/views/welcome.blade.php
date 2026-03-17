<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Portfolio') }} | Software Developer</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL@24,400,0&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        <style>
            /* Fluid responsive layout - works even without Vite build */
            html { box-sizing: border-box; width: 100%; }
            *, *::before, *::after { box-sizing: inherit; }
            body { font-family: 'Space Grotesk', sans-serif; width: 100%; margin: 0; }
            .fluid-section { width: 100%; max-width: 100%; }
            .fluid-inner { width: 100%; max-width: none; }
            @media (max-width: 1023px) {
                .hero-grid { grid-template-columns: 1fr !important; }
                .hero-image-order { order: -1 !important; }
                .hero-text-order { order: 1 !important; }
            }
            @media (max-width: 767px) {
                .stats-grid { grid-template-columns: repeat(2, 1fr) !important; }
                .projects-grid { grid-template-columns: 1fr !important; }
            }
            @media (min-width: 768px) {
                .stats-grid { grid-template-columns: repeat(4, 1fr) !important; }
                .projects-grid { grid-template-columns: repeat(2, 1fr) !important; }
            }
        </style>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 transition-colors duration-300 min-h-screen overflow-x-hidden">
        <div class="relative flex min-h-screen flex-col overflow-x-hidden w-full min-w-0">
            <div class="layout-container flex h-full grow flex-col w-full min-w-0">
                <!-- Navigation -->
                <header class="fluid-section flex flex-wrap items-center justify-between gap-3 border-b border-solid border-slate-200 dark:border-slate-800 px-8 py-3 sm:py-4 w-full min-w-0">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 text-primary shrink-0">
                        <span class="material-symbols-outlined text-2xl sm:text-3xl">rocket_launch</span>
                        <h2 class="text-slate-900 dark:text-slate-100 text-lg sm:text-xl font-bold leading-tight tracking-tight font-display truncate">{{ config('app.name', 'DevPortfolio') }}</h2>
                    </a>
                    <div class="flex flex-1 justify-end gap-4 sm:gap-6 md:gap-8 items-center min-w-0">
                        <nav class="hidden md:flex items-center gap-6 lg:gap-8 shrink-0">
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#projects">Projects</a>
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#projects">Skills</a>
                            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#projects">About</a>
                        </nav>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="flex shrink-0 cursor-pointer items-center justify-center rounded-full h-9 sm:h-10 px-4 sm:px-5 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-slate-600 dark:text-slate-400 hover:text-primary text-sm font-medium transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="flex shrink-0 cursor-pointer items-center justify-center rounded-full h-9 sm:h-10 px-4 sm:px-5 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
                                        Hire Me
                                    </a>
                                @endif
                            @endauth
                        @else
                            <a href="#contact" class="flex shrink-0 cursor-pointer items-center justify-center rounded-full h-9 sm:h-10 px-4 sm:px-5 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
                                Hire Me
                            </a>
                        @endif
                    </div>
                </header>

                <main class="flex-1 flex flex-col items-center w-full min-w-0">
                    <!-- Hero Section -->
                    <div class="fluid-section w-full min-w-0 px-12 sm:px-16 lg:px-20 py-10 sm:py-16 lg:py-24">
                        <div class="fluid-inner w-full min-w-0">
                        <div class="hero-grid grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12 items-center min-w-0">
                            <div class="hero-text-order flex flex-col gap-6 sm:gap-8 order-2 lg:order-1 min-w-0">
                                <div class="flex flex-col gap-3 sm:gap-4 min-w-0">
                                    <span class="text-primary font-bold tracking-widest uppercase text-xs sm:text-sm">Available for work</span>
                                    <h1 class="text-slate-900 dark:text-slate-100 text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-[1.1] tracking-tight font-display min-w-0">
                                        Hi, I'm Alex Chen.<br>
                                        <span class="text-primary">Software Developer.</span>
                                    </h1>
                                    <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg lg:text-xl max-w-lg leading-relaxed min-w-0">
                                        Building digital experiences with precision and purpose. Focused on clean code, performance, and user-centric design.
                                    </p>
                                </div>
                                <div class="flex flex-wrap gap-3 sm:gap-4">
                                    <a href="#projects" class="flex w-full sm:w-auto min-w-0 sm:min-w-[140px] cursor-pointer items-center justify-center rounded-xl h-12 sm:h-14 px-6 sm:px-8 bg-primary text-white text-sm sm:text-base font-bold shadow-lg shadow-primary/20 hover:-translate-y-0.5 transition-all">
                                        View My Work
                                    </a>
                                    <a href="#contact" class="flex w-full sm:w-auto min-w-0 sm:min-w-[140px] cursor-pointer items-center justify-center rounded-xl h-12 sm:h-14 px-6 sm:px-8 border border-slate-300 dark:border-slate-700 bg-transparent text-slate-900 dark:text-slate-100 text-sm sm:text-base font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                                        Contact Me
                                    </a>
                                </div>
                            </div>
                            <div class="hero-image-order order-1 lg:order-2 flex justify-center lg:justify-end min-w-0 w-full">
                                <div class="relative group w-full max-w-[280px] sm:max-w-[350px] lg:max-w-[450px]">
                                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-blue-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                                    <div class="relative w-full aspect-square overflow-hidden rounded-2xl bg-slate-200 dark:bg-slate-800 border border-slate-300 dark:border-slate-700">
                                        <img alt="Profile portrait" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500 max-w-full" src="{{ asset('images/Profile.png') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div id="projects" class="fluid-section w-full min-w-0 px-8 pb-12 sm:pb-16 lg:pb-20">
                        <div class="fluid-inner w-full min-w-0">
                        <div class="stats-grid grid grid-cols-2 md:grid-cols-4 gap-2 sm:gap-3 md:gap-4">
                            <div class="flex flex-col gap-1 sm:gap-2 rounded-lg sm:rounded-xl p-4 sm:p-6 lg:p-8 bg-white/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 backdrop-blur-sm min-w-0">
                                <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Experience</p>
                                <p class="text-slate-900 dark:text-slate-100 text-xl sm:text-2xl lg:text-3xl font-bold font-display">5+ Years</p>
                            </div>
                            <div class="flex flex-col gap-1 sm:gap-2 rounded-lg sm:rounded-xl p-4 sm:p-6 lg:p-8 bg-white/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 backdrop-blur-sm min-w-0">
                                <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Projects</p>
                                <p class="text-slate-900 dark:text-slate-100 text-xl sm:text-2xl lg:text-3xl font-bold font-display">40+ Done</p>
                            </div>
                            <div class="flex flex-col gap-1 sm:gap-2 rounded-lg sm:rounded-xl p-4 sm:p-6 lg:p-8 bg-white/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 backdrop-blur-sm min-w-0">
                                <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Clients</p>
                                <p class="text-slate-900 dark:text-slate-100 text-xl sm:text-2xl lg:text-3xl font-bold font-display">25+ Global</p>
                            </div>
                            <div class="flex flex-col gap-1 sm:gap-2 rounded-lg sm:rounded-xl p-4 sm:p-6 lg:p-8 bg-white/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 backdrop-blur-sm min-w-0">
                                <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Satisfaction</p>
                                <p class="text-slate-900 dark:text-slate-100 text-xl sm:text-2xl lg:text-3xl font-bold font-display">100%</p>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Featured Projects Preview -->
                    <div class="fluid-section w-full min-w-0 px-8 py-6 sm:py-8 lg:py-10">
                        <div class="fluid-inner w-full min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 lg:mb-10">
                            <div class="flex flex-col gap-2 min-w-0">
                                <h2 class="text-slate-900 dark:text-slate-100 text-2xl sm:text-3xl font-bold font-display">Selected Projects</h2>
                                <div class="h-1 w-12 bg-primary rounded-full"></div>
                            </div>
                            <a class="text-primary font-bold text-sm flex items-center gap-2 group shrink-0 self-start sm:self-auto" href="#">
                                Explore All <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                            </a>
                        </div>
                        <div class="projects-grid grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 lg:gap-8 min-w-0">
                            <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl aspect-[16/9] bg-slate-800 border border-slate-700 min-w-0">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" style="background-image: linear-gradient(to top, rgba(16, 22, 34, 0.9), transparent), url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80');"></div>
                                <div class="absolute bottom-0 left-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">
                                    <span class="text-xs font-bold text-primary bg-primary/20 px-3 py-1 rounded-full mb-2 sm:mb-3 inline-block">FINTECH</span>
                                    <h3 class="text-white text-xl sm:text-2xl font-bold font-display">Nexus Dashboard</h3>
                                    <p class="text-slate-300 text-xs sm:text-sm mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Modern asset management platform for enterprise clients.</p>
                                </div>
                            </div>
                            <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl aspect-[16/9] bg-slate-800 border border-slate-700 min-w-0">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" style="background-image: linear-gradient(to top, rgba(16, 22, 34, 0.9), transparent), url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80');"></div>
                                <div class="absolute bottom-0 left-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">
                                    <span class="text-xs font-bold text-primary bg-primary/20 px-3 py-1 rounded-full mb-2 sm:mb-3 inline-block">E-COMMERCE</span>
                                    <h3 class="text-white text-xl sm:text-2xl font-bold font-display">Aura Marketplace</h3>
                                    <p class="text-slate-300 text-xs sm:text-sm mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Sustainable fashion platform with headless architecture.</p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </main>

                <!-- Footer -->
                <footer id="contact" class="fluid-section w-full min-w-0 px-8 py-8 sm:py-10 lg:py-12 border-t border-slate-200 dark:border-slate-800 mt-12 sm:mt-16 lg:mt-20">
                    <div class="fluid-inner w-full min-w-0">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 sm:gap-6 text-center md:text-left">
                        <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm order-2 md:order-1">
                            © {{ date('Y') }} Alex Chen. Built with precision.
                        </p>
                        <div class="flex gap-4 sm:gap-6 order-1 md:order-2">
                            <a class="text-slate-500 hover:text-primary transition-colors" href="#" aria-label="GitHub"><span class="material-symbols-outlined">code</span></a>
                            <a class="text-slate-500 hover:text-primary transition-colors" href="#" aria-label="Email"><span class="material-symbols-outlined">alternate_email</span></a>
                            <a class="text-slate-500 hover:text-primary transition-colors" href="#" aria-label="LinkedIn"><span class="material-symbols-outlined">groups</span></a>
                        </div>
                    </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
