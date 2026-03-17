<aside id="admin-sidebar" class="admin-sidebar w-64 shrink-0 border-r border-slate-200 dark:border-slate-800 flex flex-col bg-white dark:bg-background-dark fixed inset-y-0 left-0 z-30 transition-transform duration-300 ease-out lg:translate-x-0">
    <div class="p-4 md:p-5 flex flex-col gap-5 md:gap-6 h-full overflow-y-auto">
        {{-- Logo --}}
        <div class="flex items-center gap-3">
            <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center overflow-hidden shrink-0">
                <img src="{{ asset('images/portfoliologo.png') }}" alt="Portfolio" class="size-10 w-full h-full object-contain p-0.5">
            </div>
            <div class="flex flex-col min-w-0">
                <h1 class="text-slate-900 dark:text-slate-100 text-base font-bold leading-none">Admin Panel</h1>
                <p class="text-slate-500 dark:text-slate-400 text-xs font-medium mt-1">Portfolio Manager</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex flex-col gap-1 flex-1">
            @php
                $navItems = [
                    ['route' => 'admin.dashboard',  'icon' => 'dashboard',    'label' => 'Dashboard'],
                    ['route' => 'admin.content',    'icon' => 'description',  'label' => 'Content'],
                    ['route' => 'admin.projects',   'icon' => 'work',         'label' => 'Projects'],
                    ['route' => 'admin.messages',   'icon' => 'chat_bubble',  'label' => 'Messages'],
                    ['route' => 'admin.settings',   'icon' => 'settings',     'label' => 'Settings'],
                ];
            @endphp

            @foreach ($navItems as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                          {{ $active ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined {{ $active ? 'fill' : '' }}">{{ $item['icon'] }}</span>
                    {{ $item['label'] }}

                    {{-- Unread badge on Messages --}}
                    @if ($item['route'] === 'admin.messages')
                        @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                        @if ($unread > 0)
                            <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded-full
                                         {{ $active ? 'bg-white/30 text-white' : 'bg-red-500 text-white' }}">
                                {{ $unread }}
                            </span>
                        @endif
                    @endif
                </a>
            @endforeach
        </nav>

        {{-- Admin user info + logout --}}
        <div class="border-t border-slate-200 dark:border-slate-800 pt-4 flex flex-col gap-3">
            <div class="flex items-center gap-3 px-2">
                <img src="{{ auth('admin')->user()->avatar_path ? asset(auth('admin')->user()->avatar_path) : asset('images/portfoliologo.png') }}" alt="Admin" class="size-10 rounded-full object-cover shrink-0">
                <div class="flex flex-col overflow-hidden min-w-0">
                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100 truncate">{{ auth('admin')->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ auth('admin')->user()->email ?? '' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 text-xs font-bold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    Sign out
                </button>
            </form>
        </div>
    </div>
</aside>
