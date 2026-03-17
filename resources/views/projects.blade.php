@extends('layouts.public')

@section('title', 'Portfolio - Experience')

@section('content')

<div class="px-4 sm:px-6 md:px-8 py-16">
    <div class="mb-10">
        <h1 class="text-4xl sm:text-5xl font-bold mb-3">Experience</h1>
        <div class="h-1 w-12 bg-primary rounded-full mb-4"></div>
        <p class="text-slate-500 dark:text-slate-400 max-w-xl">A collection of work and experience — from web apps to complete systems.</p>
    </div>

    @if ($projects->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-slate-400 dark:text-slate-600">
            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            <p class="font-bold text-lg">No experience entries yet.</p>
            <p class="text-sm">Items will appear here once added by the admin.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div class="group bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                    <div class="h-44 bg-slate-200 dark:bg-slate-700 relative overflow-hidden">
                        @if ($project->thumbnail_path)
                            <img src="{{ asset($project->thumbnail_path) }}" alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-primary/30 to-blue-700/30 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                        @endif
                        @if ($project->category)
                            <div class="absolute top-3 left-3 bg-white/90 dark:bg-slate-900/90 backdrop-blur px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider text-slate-700 dark:text-slate-200">
                                {{ $project->category }}
                            </div>
                        @endif
                        @if ($project->is_featured)
                            <div class="absolute top-3 right-3 bg-amber-400 text-white px-2 py-0.5 rounded-md text-[10px] font-bold">★ Featured</div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 group-hover:text-primary transition-colors">{{ $project->title }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 line-clamp-2 leading-relaxed">
                            {{ $project->short_desc ?? $project->description ?? 'No description available.' }}
                        </p>
                        @if ($project->completed_at)
                            <p class="text-xs text-slate-400 mt-2">Completed {{ $project->completed_at->format('M Y') }}</p>
                        @endif
                        <div class="flex gap-2 mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                            @if ($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" rel="noopener"
                                   class="flex items-center gap-1 text-xs font-bold text-primary hover:underline">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    Live Demo
                                </a>
                            @endif
                            @if ($project->repo_url)
                                <a href="{{ $project->repo_url }}" target="_blank" rel="noopener"
                                   class="flex items-center gap-1 text-xs font-bold text-slate-500 hover:text-slate-900 dark:hover:text-slate-100">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                    Source
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
