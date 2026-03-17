@extends('admin.layouts.app')

@section('title', 'Portfolio - Admin Dashboard')
@section('header', 'Dashboard Overview')

@section('content')

{{-- Welcome --}}
<div class="flex flex-col gap-0.5">
    <h1 class="text-xl md:text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
        Welcome back, {{ auth('admin')->user()->name ?? 'Admin' }} 👋
    </h1>
    <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm">Here's a real-time snapshot of your portfolio.</p>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
    @php
        $statCards = [
            ['label' => 'Total Views',    'value' => $totalViews,    'icon' => 'visibility',  'color' => 'text-primary'],
            ['label' => 'Total Projects', 'value' => $totalProjects, 'icon' => 'work',        'color' => 'text-emerald-500'],
            ['label' => 'Total Messages', 'value' => $totalMessages, 'icon' => 'mail',        'color' => 'text-purple-500'],
            ['label' => 'Unread Messages','value' => $unreadMessages,'icon' => 'mark_email_unread','color' => 'text-rose-500'],
        ];
    @endphp

    @foreach ($statCards as $card)
        <div class="bg-white dark:bg-slate-800/50 p-4 md:p-5 rounded-xl border border-slate-200 dark:border-slate-800 flex flex-col gap-2 min-w-0">
            <div class="flex items-center justify-between">
                <p class="text-xs md:text-sm font-medium text-slate-500 dark:text-slate-400">{{ $card['label'] }}</p>
                <span class="material-symbols-outlined {{ $card['color'] }} text-xl">{{ $card['icon'] }}</span>
            </div>
            <h3 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($card['value']) }}</h3>
        </div>
    @endforeach
</div>

{{-- Site Traffic Graph --}}
<div class="bg-white dark:bg-slate-800/50 p-4 md:p-5 rounded-xl border border-slate-200 dark:border-slate-800 flex flex-col gap-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
        <div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Site Traffic</p>
            <h3 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($totalViews) }} <span class="text-base font-medium text-slate-400">total views</span></h3>
        </div>
        <div class="flex items-center gap-2 bg-slate-100 dark:bg-slate-800 p-1 rounded-lg shrink-0">
            <button id="btn-7days" onclick="switchChart(7)" type="button" class="px-3 py-1.5 text-xs font-bold rounded-md bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-slate-100">Last 7 Days</button>
            <button id="btn-30days" onclick="switchChart(30)" type="button" class="px-3 py-1.5 text-xs font-bold rounded-md text-slate-500 hover:text-slate-900 dark:hover:text-slate-100 transition-colors">30 Days</button>
        </div>
    </div>

    @if ($totalViews === 0)
        <div class="h-40 flex items-center justify-center text-slate-400 dark:text-slate-600 text-sm border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl">
            No traffic data yet. Views will appear here once visitors land on your site.
        </div>
    @else
        <div id="chart-container" class="h-48 md:h-64 w-full relative">
            <canvas id="trafficChart" class="w-full h-full"></canvas>
        </div>
        <div id="chart-labels" class="flex justify-between px-2 mt-1"></div>
    @endif
</div>

{{-- Recent Messages & Active Projects --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

    {{-- Recent Messages --}}
    <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden">
        <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <h4 class="font-bold text-slate-900 dark:text-slate-100">Recent Messages</h4>
            <a href="{{ route('admin.messages') }}" class="text-primary text-xs font-bold hover:underline">View All</a>
        </div>

        @if ($recentMessages->isEmpty())
            <div class="p-8 text-center text-slate-400 dark:text-slate-600 text-sm">
                <span class="material-symbols-outlined text-4xl block mb-2">inbox</span>
                No messages yet.
            </div>
        @else
            <div class="flex flex-col divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($recentMessages as $msg)
                    <a href="{{ route('admin.messages.show', $msg) }}"
                       class="p-3 flex items-center gap-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <div class="size-9 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xs font-bold shrink-0">
                            {{ $msg->initials }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-900 dark:text-slate-100 flex items-center gap-1.5">
                                {{ $msg->name }}
                                @if (!$msg->is_read)
                                    <span class="size-2 bg-primary rounded-full inline-block"></span>
                                @endif
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Str::limit($msg->message, 60) }}</p>
                        </div>
                        <span class="text-[10px] font-medium text-slate-400 shrink-0">{{ $msg->created_at->diffForHumans(null, true) }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Active Projects --}}
    <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden">
        <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <h4 class="font-bold text-slate-900 dark:text-slate-100">Active Projects</h4>
            <a href="{{ route('admin.projects') }}" class="text-primary text-xs font-bold hover:underline">Manage</a>
        </div>

        @if ($activeProjects->isEmpty())
            <div class="p-8 text-center text-slate-400 dark:text-slate-600 text-sm">
                <span class="material-symbols-outlined text-4xl block mb-2">work_off</span>
                No projects added yet.
            </div>
        @else
            <div class="flex flex-col divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($activeProjects as $project)
                    <div class="p-3 flex items-center gap-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <div class="size-9 rounded-lg bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-lg">work</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-900 dark:text-slate-100 truncate">{{ $project->title }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $project->category ?? 'Uncategorized' }}</p>
                        </div>
                        @if ($project->is_featured)
                            <span class="text-[10px] font-bold px-2 py-0.5 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-full shrink-0">Featured</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
const data7  = @json($days7);
const data30 = @json($days30);
let currentDays = 7;

function switchChart(days) {
    currentDays = days;
    document.getElementById('btn-7days').className  = days === 7
        ? 'px-3 py-1.5 text-xs font-bold rounded-md bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-slate-100'
        : 'px-3 py-1.5 text-xs font-bold rounded-md text-slate-500 hover:text-slate-900 dark:hover:text-slate-100 transition-colors';
    document.getElementById('btn-30days').className = days === 30
        ? 'px-3 py-1.5 text-xs font-bold rounded-md bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-slate-100'
        : 'px-3 py-1.5 text-xs font-bold rounded-md text-slate-500 hover:text-slate-900 dark:hover:text-slate-100 transition-colors';
    renderChart(days === 7 ? data7 : data30);
}

function renderChart(data) {
    const container = document.getElementById('chart-container');
    if (!container) return;

    const counts = data.map(d => d.count);
    const labels = data.map(d => d.label);
    const max    = Math.max(...counts, 1);
    const W = container.clientWidth || 600;
    const H = container.clientHeight || 200;
    const pad = { top: 10, bottom: 30, left: 30, right: 10 };
    const plotW = W - pad.left - pad.right;
    const plotH = H - pad.top - pad.bottom;

    const pts = counts.map((c, i) => {
        const x = pad.left + (i / (counts.length - 1 || 1)) * plotW;
        const y = pad.top + plotH - (c / max) * plotH;
        return `${x},${y}`;
    });

    const linePath = `M ${pts.join(' L ')}`;
    const areaPath = `M ${pts[0]} L ${pts.join(' L ')} L ${pad.left + plotW},${pad.top + plotH} L ${pad.left},${pad.top + plotH} Z`;

    const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${W}" height="${H}" viewBox="0 0 ${W} ${H}">
        <defs>
            <linearGradient id="g" x1="0" x2="0" y1="0" y2="1">
                <stop offset="0%" stop-color="#256af4" stop-opacity="0.25"/>
                <stop offset="100%" stop-color="#256af4" stop-opacity="0"/>
            </linearGradient>
        </defs>
        <path d="${areaPath}" fill="url(#g)"/>
        <path d="${linePath}" fill="none" stroke="#256af4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        ${counts.map((c, i) => {
            const x = pad.left + (i / (counts.length - 1 || 1)) * plotW;
            const y = pad.top + plotH - (c / max) * plotH;
            return `<circle cx="${x}" cy="${y}" r="3.5" fill="#256af4"/>`;
        }).join('')}
        ${counts.map((c, i) => {
            const x = pad.left + (i / (counts.length - 1 || 1)) * plotW;
            return `<text x="${x}" y="${H - 6}" text-anchor="middle" font-size="10" fill="#94a3b8">${labels[i]}</text>`;
        }).join('')}
    </svg>`;

    container.innerHTML = svg;
}

document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('chart-container')) {
        renderChart(data7);
    }
});
</script>
@endpush
