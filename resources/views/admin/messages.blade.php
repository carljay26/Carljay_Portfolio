@extends('admin.layouts.app')

@section('title', 'Portfolio - Admin Messages')
@section('header', 'Inbox')

@section('content')

@if (session('success'))
    <div id="flash-msg" class="flex items-center gap-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">check_circle</span> {{ session('success') }}
    </div>
@endif

<div class="flex gap-0 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden min-h-[600px]">

    {{-- Message list --}}
    <div class="w-full sm:w-72 md:w-80 flex-shrink-0 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark flex flex-col {{ $active ? 'hidden sm:flex' : 'flex' }}">
        <div class="p-3 border-b border-slate-200 dark:border-slate-800">
            <h2 class="font-bold text-slate-900 dark:text-slate-100 text-base mb-2">Messages</h2>
            <div class="flex gap-2 text-xs">
                <span class="px-2 py-1 rounded-full bg-primary text-white font-bold">All ({{ $messages->count() }})</span>
                <span class="px-2 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 font-bold">
                    Unread ({{ $messages->where('is_read', false)->count() }})
                </span>
            </div>
        </div>

        @if ($messages->isEmpty())
            <div class="flex-1 flex flex-col items-center justify-center text-slate-400 dark:text-slate-600 p-8 text-center">
                <span class="material-symbols-outlined text-5xl mb-2">inbox</span>
                <p class="text-sm font-medium">No messages yet.</p>
            </div>
        @else
            <div class="flex-1 overflow-y-auto">
                @foreach ($messages as $msg)
                    @php $isActive = isset($active) && $active->id === $msg->id; @endphp
                    <a href="{{ route('admin.messages.show', $msg) }}"
                       class="block p-4 transition-colors border-b border-slate-100 dark:border-slate-800
                              {{ $isActive ? 'bg-primary/5 border-l-4 border-l-primary' : 'hover:bg-slate-50 dark:hover:bg-slate-800 border-l-4 border-l-transparent' }}">
                        <div class="flex justify-between items-start mb-0.5">
                            <span class="font-bold text-sm text-slate-900 dark:text-slate-100 flex items-center gap-1.5">
                                {{ $msg->name }}
                                @if (!$msg->is_read)
                                    <span class="size-2 bg-primary rounded-full inline-block flex-shrink-0"></span>
                                @endif
                            </span>
                            <span class="text-[10px] text-slate-400 flex-shrink-0">{{ $msg->created_at->diffForHumans(null, true) }}</span>
                        </div>
                        <p class="text-xs text-primary font-medium mb-0.5 line-clamp-1">{{ $msg->subject ?? '(no subject)' }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed">{{ $msg->message }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Message detail --}}
    <div class="flex-1 bg-white dark:bg-background-dark flex flex-col">
        @if (!$active)
            <div class="flex-1 flex flex-col items-center justify-center text-slate-400 dark:text-slate-600">
                <span class="material-symbols-outlined text-6xl mb-3">mark_email_unread</span>
                <p class="font-bold">Select a message to read</p>
            </div>
        @else
            {{-- Detail header --}}
            <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="size-11 rounded-full bg-primary/10 flex items-center justify-center text-primary text-sm font-bold flex-shrink-0">
                        {{ $active->initials }}
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-slate-900 dark:text-slate-100 truncate">{{ $active->name }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $active->email }}</p>
                    </div>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    @if (!$active->is_read)
                        <form method="POST" action="{{ route('admin.messages.read', $active) }}">
                            @csrf
                            <button type="submit" class="p-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 text-xs" title="Mark as read">
                                <span class="material-symbols-outlined text-lg">mark_email_read</span>
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.messages.destroy', $active) }}"
                          onsubmit="return confirm('Delete this message?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20" title="Delete">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Message body --}}
            <div class="flex-1 p-5 md:p-8 overflow-y-auto">
                <div class="max-w-2xl">
                    <div class="flex justify-between items-start mb-6">
                        <h4 class="text-xl font-bold text-slate-900 dark:text-slate-100">{{ $active->subject ?? '(no subject)' }}</h4>
                        <span class="text-xs text-slate-400 flex-shrink-0 ml-4">{{ $active->created_at->format('M d, Y \a\t h:i A') }}</span>
                    </div>
                    <div class="text-slate-700 dark:text-slate-300 leading-relaxed text-sm whitespace-pre-line bg-slate-50 dark:bg-slate-800/50 rounded-xl p-5 border border-slate-200 dark:border-slate-700">
                        {{ $active->message }}
                    </div>

                    @if ($active->reply_text)
                        <div class="mt-5 p-4 bg-primary/5 border border-primary/20 rounded-xl">
                            <p class="text-xs font-bold text-primary mb-2 uppercase tracking-wider">Your Reply · {{ $active->replied_at?->format('M d, Y') }}</p>
                            <p class="text-sm text-slate-700 dark:text-slate-300 whitespace-pre-line">{{ $active->reply_text }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Reply area --}}
            <div class="p-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/30">
                <form method="POST" action="{{ route('admin.messages.reply', $active) }}">
                    @csrf
                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-3">
                        <textarea name="reply_text" rows="3" required
                                  placeholder="Write your reply..."
                                  class="w-full bg-transparent border-none focus:ring-0 text-sm resize-none placeholder-slate-400 dark:placeholder-slate-500 text-slate-900 dark:text-slate-100 outline-none">{{ old('reply_text', $active->reply_text) }}</textarea>
                        <div class="flex justify-end pt-2 border-t border-slate-100 dark:border-slate-700 mt-1">
                            <button type="submit"
                                    class="flex items-center gap-2 text-xs font-bold bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-all">
                                <span class="material-symbols-outlined text-sm">send</span>
                                {{ $active->reply_text ? 'Update Reply' : 'Send Reply' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
setTimeout(() => { const f = document.getElementById('flash-msg'); if(f) f.style.display='none'; }, 4000);
</script>
@endpush
