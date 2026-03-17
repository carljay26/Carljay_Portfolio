@extends('layouts.public')

@section('title', 'Portfolio - About')

@section('content')

{{-- Profile header --}}
<div class="px-4 sm:px-6 md:px-8 py-16">
    <div class="max-w-4xl mx-auto flex flex-col items-center">
        <div class="relative mb-6">
            <div class="absolute inset-0 bg-primary/20 blur-2xl rounded-full"></div>
            @if ($profile?->avatar_path)
                <img src="{{ asset($profile->avatar_path) }}" alt="{{ $profile->full_name }}"
                     class="relative size-32 rounded-full object-cover border-4 border-slate-200 dark:border-slate-800">
            @else
                <div class="relative size-32 rounded-full bg-primary/10 border-4 border-slate-200 dark:border-slate-800 flex items-center justify-center text-primary text-4xl font-bold">
                    {{ substr($profile->full_name ?? 'P', 0, 1) }}
                </div>
            @endif
        </div>
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-2">{{ $profile->full_name ?? 'N/A' }}</h1>
            <p class="text-primary text-lg font-medium">{{ $profile->title ?? 'N/A' }}</p>
            @if ($profile?->location)
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1 flex items-center justify-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $profile->location }}
                </p>
            @endif
        </div>

        {{-- Bio --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full mb-16">
            <div>
                <h3 class="text-2xl font-bold mb-4">The Journey</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                    {{ $profile->bio ?? 'N/A' }}
                </p>
            </div>
            <div>
                <h3 class="text-2xl font-bold mb-4">Contact Info</h3>
                <ul class="space-y-3">
                    @if ($profile?->email)
                        <li class="flex items-center gap-3 text-sm">
                            <span class="size-8 rounded-lg bg-primary/10 flex items-center justify-center text-primary">@</span>
                            <span class="text-slate-600 dark:text-slate-400">{{ $profile->email }}</span>
                        </li>
                    @endif
                    @if ($profile?->phone)
                        <li class="flex items-center gap-3 text-sm">
                            <span class="size-8 rounded-lg bg-primary/10 flex items-center justify-center text-primary">📞</span>
                            <span class="text-slate-600 dark:text-slate-400">{{ $profile->phone }}</span>
                        </li>
                    @endif
                    @if ($profile?->location)
                        <li class="flex items-center gap-3 text-sm">
                            <span class="size-8 rounded-lg bg-primary/10 flex items-center justify-center text-primary">📍</span>
                            <span class="text-slate-600 dark:text-slate-400">{{ $profile->location }}</span>
                        </li>
                    @endif
                    <li class="flex items-center gap-3 text-sm">
                        <span class="size-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-500">✓</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-medium">{{ $profile->availability ?? 'N/A' }}</span>
                    </li>
                </ul>

                @if ($socialLinks->isNotEmpty())
                    @php
                        $socialIcons = [
                            'Email'    => 'images/gmail.png',
                            'LinkedIn' => 'images/linkedIn.png',
                            'GitHub'   => 'images/github.png',
                            'Discord'  => 'images/discord.png',
                            'Facebook' => 'images/facebook.png',
                        ];
                    @endphp
                    <div class="flex gap-3 mt-5">
                        @foreach ($socialLinks as $link)
                            @php
                                $socialHref = $link->url;
                                if ($link->platform === 'Email' && str_starts_with($link->url, 'mailto:')) {
                                    $email = trim(explode('?', substr($link->url, 7))[0]);
                                    $socialHref = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($email);
                                }
                            @endphp
                            <a href="{{ $socialHref }}" target="_blank" rel="noopener"
                               class="size-10 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-primary/10 hover:text-primary flex items-center justify-center text-slate-500 transition-colors overflow-hidden"
                               title="{{ $link->platform }}">
                                @if (isset($socialIcons[$link->platform]))
                                    <img src="{{ asset($socialIcons[$link->platform]) }}" alt="{{ $link->platform }}" class="size-5 object-contain">
                                @else
                                    <span class="text-xs font-bold">{{ strtoupper(substr($link->platform, 0, 2)) }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Education --}}
        @if ($educations->isNotEmpty())
        <div class="w-full mb-16">
            <div class="text-center mb-10">
                <h3 class="text-2xl font-bold mb-2">Education</h3>
                <div class="h-1 w-16 bg-primary mx-auto rounded-full"></div>
            </div>
            <div class="space-y-6">
                @foreach ($educations as $edu)
                    <div class="flex flex-col sm:flex-row sm:items-start gap-3 p-4 rounded-xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                            {{ $edu->type === 'primary' ? 'bg-amber-500/20 text-amber-600 dark:text-amber-400' : '' }}
                            {{ $edu->type === 'secondary' ? 'bg-blue-500/20 text-blue-600 dark:text-blue-400' : '' }}
                            {{ $edu->type === 'college' ? 'bg-primary/20 text-primary' : '' }}
                        ">
                            {{ ucfirst($edu->type) }}
                        </span>
                        <div class="flex-1">
                            <h4 class="font-bold text-slate-900 dark:text-slate-100">{{ $edu->school_name }}</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $edu->year }}</p>
                            @if ($edu->description)
                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">{{ $edu->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Skills --}}
        <div class="w-full">
            <div class="text-center mb-10">
                <h3 class="text-2xl font-bold mb-2">Technical Skills</h3>
                <div class="h-1 w-16 bg-primary mx-auto rounded-full"></div>
            </div>

            @if ($skillCategories->isEmpty())
                <p class="text-center text-slate-400">No skills added yet.</p>
            @else
                @foreach ($skillCategories as $cat)
                    @if ($cat->skills->isNotEmpty())
                        <div class="mb-6">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ $cat->name }}</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($cat->skills as $skill)
                                    <span class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-medium hover:border-primary hover:text-primary transition-colors group">
                                        {{ $skill->name }}
                                        <span class="text-xs text-slate-400 group-hover:text-primary ml-1">{{ $skill->proficiency }}%</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
