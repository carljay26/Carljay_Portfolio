@extends('layouts.public')

@section('title', 'Portfolio - Home')

@section('content')

{{-- Hero --}}
<div class="px-4 sm:px-6 md:px-8 py-16 md:py-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="flex flex-col gap-6 order-2 lg:order-1 px-2 sm:px-4 md:px-6">
            <span class="text-primary font-bold tracking-widest uppercase text-xs">
                {{ $profile->availability ?? 'Available for work' }}
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold leading-[1.1] tracking-tight">
                Hi, I'm {{ $profile->full_name ?? 'N/A' }}.<br>
                <span class="text-primary">{{ $profile->title ?? 'N/A' }}</span>
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg max-w-lg leading-relaxed">
                {{ $profile->tagline ?? 'N/A' }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('projects') }}" class="flex items-center justify-center rounded-xl h-12 px-7 bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:-translate-y-0.5 transition-all">View Experience</a>
                <a href="{{ route('contact') }}"  class="flex items-center justify-center rounded-xl h-12 px-7 border border-slate-300 dark:border-slate-700 bg-transparent text-slate-900 dark:text-slate-100 text-sm font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">Contact Me</a>
            </div>
        </div>
        <div class="order-1 lg:order-2 flex justify-center lg:justify-end px-2 sm:px-4 md:px-6">
            <div class="relative group w-full max-w-sm">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary to-blue-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative w-full aspect-square overflow-hidden rounded-2xl bg-slate-200 dark:bg-slate-800 border border-slate-300 dark:border-slate-700">
                    @if ($profile?->avatar_path)
                        <img src="{{ asset($profile->avatar_path) }}" alt="Profile" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-slate-400 text-6xl font-bold">{{ substr($profile->full_name ?? 'P', 0, 1) }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Stats --}}
@if ($stats->isNotEmpty())
<div class="px-4 sm:px-6 md:px-8 pb-16">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach ($stats as $stat)
            <div class="flex flex-col gap-1 rounded-xl p-5 bg-white/60 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 backdrop-blur-sm">
                <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase tracking-wider">{{ $stat->label }}</p>
                <p class="text-slate-900 dark:text-slate-100 text-2xl md:text-3xl font-bold">
                    @if ($stat->label === 'Satisfaction' && $stat->value !== '' && !str_ends_with($stat->value, '%'))
                        {{ $stat->value }}%
                    @else
                        {{ $stat->value }}
                    @endif
                </p>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- Featured Projects --}}
<div class="px-4 sm:px-6 md:px-8 py-12 border-t border-slate-200 dark:border-slate-800">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold">Selected Experience</h2>
            <div class="h-1 w-12 bg-primary rounded-full mt-2"></div>
        </div>
        <a href="{{ route('projects') }}" class="text-primary font-bold text-sm flex items-center gap-1 group">
            Explore All <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>

    @if ($projects->isEmpty())
        <div class="text-center py-16 text-slate-400 dark:text-slate-600">
            <p class="text-lg font-medium">No featured projects yet.</p>
            <p class="text-sm mt-1">Projects added in the admin panel will appear here.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($projects as $project)
                <div class="group relative overflow-hidden rounded-2xl aspect-video bg-slate-800 border border-slate-700">
                    @if ($project->thumbnail_path)
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                             style="background-image: linear-gradient(to top, rgba(16,22,34,.9), transparent 60%), url('{{ asset($project->thumbnail_path) }}')"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/30 to-blue-800/30"></div>
                    @endif
                    <div class="absolute bottom-0 left-0 p-5 w-full">
                        <span class="text-xs font-bold text-primary bg-primary/20 px-3 py-1 rounded-full mb-2 inline-block">{{ $project->category ?? 'Project' }}</span>
                        <h3 class="text-white text-xl font-bold">{{ $project->title }}</h3>
                        <p class="text-slate-300 text-xs mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">{{ $project->short_desc }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Education Preview --}}
@if ($educations->isNotEmpty())
<div class="px-4 sm:px-6 md:px-8 py-12 border-t border-slate-200 dark:border-slate-800">
    <div class="mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold">Education</h2>
        <div class="h-1 w-12 bg-primary rounded-full mt-2"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($educations->take(3) as $edu)
            <div class="p-4 rounded-xl bg-white/60 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 backdrop-blur-sm">
                <span class="inline-block px-2 py-0.5 rounded text-xs font-bold uppercase mb-2
                    {{ $edu->type === 'primary' ? 'bg-amber-500/20 text-amber-600 dark:text-amber-400' : '' }}
                    {{ $edu->type === 'secondary' ? 'bg-blue-500/20 text-blue-600 dark:text-blue-400' : '' }}
                    {{ $edu->type === 'college' ? 'bg-primary/20 text-primary' : '' }}
                ">{{ ucfirst($edu->type) }}</span>
                <h3 class="font-bold text-slate-900 dark:text-slate-100">{{ $edu->school_name }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $edu->year }}</p>
            </div>
        @endforeach
    </div>
    <a href="{{ route('about') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-primary font-bold hover:underline">
        View full education →
    </a>
</div>
@endif

{{-- Skills Preview --}}
@if ($skillCategories->isNotEmpty())
<div class="px-4 sm:px-6 md:px-8 py-12 border-t border-slate-200 dark:border-slate-800">
    <div class="mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold">Skills</h2>
        <div class="h-1 w-12 bg-primary rounded-full mt-2"></div>
    </div>
    <div class="flex flex-wrap gap-2">
        @foreach ($skillCategories as $cat)
            @foreach ($cat->skills->take(6) as $skill)
                <span class="px-3 py-1.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full text-sm font-medium text-slate-700 dark:text-slate-300 hover:border-primary hover:text-primary transition-colors">
                    {{ $skill->name }}
                </span>
            @endforeach
        @endforeach
    </div>
    <a href="{{ route('about') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-primary font-bold hover:underline">
        View all skills →
    </a>
</div>
@endif

{{-- CTA --}}
<div class="px-4 sm:px-6 md:px-8 py-16 border-t border-slate-200 dark:border-slate-800 text-center">
    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Let's work together</h2>
    <p class="text-slate-500 dark:text-slate-400 mb-6 max-w-md mx-auto">Have a project in mind? I'd love to hear about it and see how I can help.</p>
    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-xl h-12 px-8 bg-primary text-white font-bold shadow-lg shadow-primary/20 hover:-translate-y-0.5 transition-all">
        Get in Touch
    </a>
</div>

@endsection
