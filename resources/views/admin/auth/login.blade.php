<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio - Admin Login</title>
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
                        colors: {
                            primary: '#256af4',
                            'background-light': '#f5f6f8',
                            'background-dark': '#101622',
                        },
                        fontFamily: { display: ['Space Grotesk', 'sans-serif'] },
                    },
                },
            };
        </script>
    @endif
    <style>
        body { font-family: 'Space Grotesk', sans-serif; }
        .bg-glow {
            background: radial-gradient(circle at 50% 50%, rgba(37, 106, 244, 0.15) 0%, rgba(16, 22, 34, 0) 70%);
        }
        .grid-pattern {
            background-image: radial-gradient(circle, rgba(37, 106, 244, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        .login-icon { width: 1.25rem; height: 1.25rem; flex-shrink: 0; }
        .login-icon-lg { width: 1.5rem; height: 1.5rem; flex-shrink: 0; }
        .login-icon-xl { width: 1.5rem; height: 1.5rem; flex-shrink: 0; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen flex flex-col font-display selection:bg-primary selection:text-white">
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute inset-0 bg-glow"></div>
        <div class="absolute inset-0 grid-pattern opacity-40"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary/10 rounded-full blur-[100px]"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-primary/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="relative z-10 flex flex-col min-h-screen">
        <header class="w-full max-w-7xl mx-auto px-6 py-8 flex items-center justify-between">
            <div class="flex items-center gap-3 group">
                <div class="p-2 bg-primary/10 rounded-lg group-hover:bg-primary/20 transition-colors">
                    <svg class="login-icon-xl text-primary" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 18c1.1 0 1.99-.9 1.99-2L22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z"/></svg>
                </div>
                <h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold tracking-tight">Portfolio Admin</h2>
            </div>
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ url('/') }}" class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">Public Site</a>
            </div>
        </header>

        <main class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                <div class="bg-white dark:bg-[#161e2e] border border-slate-200 dark:border-slate-800 rounded-xl shadow-2xl p-8 md:p-10">
                    <div class="text-center mb-10">
                        <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-3">Welcome back</h1>
                        <p class="text-slate-500 dark:text-slate-400">Admin portal for portfolio management</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-lg border border-red-500/40 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="space-y-6" method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1" for="email">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary">
                                    <svg class="login-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                </div>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="admin@portfolio.com"
                                    class="w-full bg-slate-50 dark:bg-background-dark/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white rounded-lg pl-11 pr-4 py-3.5 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none placeholder:text-slate-400 dark:placeholder:text-slate-600"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between px-1">
                                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="password">Password</label>
                                <span class="text-xs font-medium text-primary opacity-60">Use your admin password</span>
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary">
                                    <svg class="login-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                                </div>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="••••••••"
                                    class="w-full bg-slate-50 dark:bg-background-dark/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white rounded-lg pl-11 pr-12 py-3.5 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none placeholder:text-slate-400 dark:placeholder:text-slate-600"
                                />
                            </div>
                        </div>

                        <div class="flex items-center gap-2 px-1">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                class="w-4 h-4 rounded border-slate-300 dark:border-slate-700 text-primary focus:ring-primary/20 bg-white dark:bg-background-dark"
                                {{ old('remember') ? 'checked' : '' }}
                            />
                            <label class="text-sm text-slate-600 dark:text-slate-400 cursor-pointer" for="remember">
                                Stay signed in for 30 days
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-primary hover:bg-blue-600 text-white font-bold py-4 rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-all transform active:scale-[0.98]"
                        >
                            <span>Sign in to Dashboard</span>
                            <svg class="login-icon-lg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
                        </button>
                    </form>

                    <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-800 flex flex-col items-center gap-4">
                        <p class="text-xs text-slate-500 dark:text-slate-500 text-center leading-relaxed">
                            Protected by industry standard encryption.<br>
                            Internal use only for portfolio administrators.
                        </p>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary transition-colors">
                        <svg class="login-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                        <span>Back to public site</span>
                    </a>
                </div>
            </div>
        </main>

        <footer class="w-full py-8 px-6 text-center">
            <p class="text-xs text-slate-400 dark:text-slate-600 font-medium">
                © {{ date('Y') }} Portfolio Admin Interface. All rights reserved.
            </p>
        </footer>
    </div>
</body>
</html>

