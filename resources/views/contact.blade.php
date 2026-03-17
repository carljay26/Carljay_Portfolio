@extends('layouts.public')

@section('title', 'Portfolio - Contact')

@section('content')

<div class="px-4 sm:px-6 md:px-8 py-16 flex flex-col items-center">
    <div class="w-full max-w-2xl">

        @if (session('sent'))
            <div class="mb-6 flex items-center gap-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm font-medium">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('sent') }}
            </div>
        @endif

        {{-- Hero text --}}
        <div class="mb-10">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-4">
                Let's build something <span class="text-primary">extraordinary</span> together.
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed max-w-xl">
                Have a project in mind or just want to chat about tech? Drop me a message and I'll get back to you as soon as possible.
            </p>
        </div>

        {{-- Contact form --}}
        <div class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-10 shadow-sm">
            <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500" for="name">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required placeholder="Your full name"
                               class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 h-12 px-4 text-sm focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" />
                        @error('name')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500" for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="you@example.com"
                               class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 h-12 px-4 text-sm focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" />
                        @error('email')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500" for="subject">Subject</label>
                    <input id="subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="Project inquiry..."
                           class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 h-12 px-4 text-sm focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" />
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500" for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Tell me about your project..."
                              class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 p-4 text-sm focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none resize-none">{{ old('message') }}</textarea>
                    @error('message')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <button type="submit"
                        class="w-full md:w-auto px-8 py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-primary/90 transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:-translate-y-0.5">
                    Send Message
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </form>
        </div>

        {{-- Social links --}}
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
            <div class="mt-14 flex flex-col items-center gap-6">
                <div class="flex items-center gap-4 text-slate-400">
                    <div class="h-px w-12 bg-slate-200 dark:bg-slate-800"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.2em]">Connect Elsewhere</span>
                    <div class="h-px w-12 bg-slate-200 dark:bg-slate-800"></div>
                </div>
                <div class="flex gap-4">
                    @foreach ($socialLinks as $link)
                        @php
                            $socialHref = $link->url;
                            if ($link->platform === 'Email' && str_starts_with($link->url, 'mailto:')) {
                                $email = trim(explode('?', substr($link->url, 7))[0]);
                                $socialHref = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($email);
                            }
                        @endphp
                        <a href="{{ $socialHref }}" target="_blank" rel="noopener"
                           class="h-12 w-12 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-primary/10 hover:text-primary text-slate-500 transition-all overflow-hidden"
                           title="{{ $link->platform }}">
                            @if (isset($socialIcons[$link->platform]))
                                <img src="{{ asset($socialIcons[$link->platform]) }}" alt="{{ $link->platform }}" class="size-6 object-contain">
                            @else
                                <span class="text-xs font-bold">{{ strtoupper(substr($link->platform, 0, 2)) }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
