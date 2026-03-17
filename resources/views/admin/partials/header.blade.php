<header class="h-14 md:h-16 border-b border-slate-200 dark:border-slate-800 px-3 sm:px-4 md:px-6 flex items-center justify-between gap-2 bg-white dark:bg-background-dark/50 backdrop-blur-sm sticky top-0 z-10 min-w-0">
    <div class="flex items-center gap-2 min-w-0">
        <button type="button" id="admin-sidebar-toggle" class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors lg:hidden shrink-0" aria-label="Toggle menu">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <h2 class="text-base md:text-lg font-bold text-slate-900 dark:text-slate-100 truncate">@yield('header', 'Dashboard')</h2>
    </div>
    <div class="flex items-center gap-2 shrink-0">
        <a href="{{ url('/') }}" target="_blank" rel="noopener"
           class="hidden sm:flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
            <span class="material-symbols-outlined text-sm">open_in_new</span>
            View Site
        </a>
    </div>
</header>
