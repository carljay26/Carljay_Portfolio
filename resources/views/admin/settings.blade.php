@extends('admin.layouts.app')

@section('title', 'Portfolio - Admin Settings')
@section('header', 'Settings')

@section('content')

@if (session('success'))
    <div id="flash-msg" class="flex items-center gap-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">check_circle</span> {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="flex flex-col gap-1 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 rounded-xl px-4 py-3 text-sm">
        @foreach ($errors->all() as $err)
            <p>• {{ $err }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('admin.settings.update') }}" class="flex flex-col gap-5" enctype="multipart/form-data">
    @csrf

    {{-- Account Info --}}
    <section class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl p-5 md:p-6">
        <div class="flex items-center gap-2 mb-5">
            <span class="material-symbols-outlined text-primary">manage_accounts</span>
            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Account Information</h3>
        </div>
        <div class="flex items-center gap-4 mb-6">
            <div class="relative shrink-0 group">
                <img id="admin-avatar-preview" src="{{ $admin->avatar_path ? asset($admin->avatar_path) : asset('images/portfoliologo.png') }}" alt="Avatar" class="size-16 rounded-full object-cover border-2 border-primary/30">
                <label for="admin-avatar" class="absolute bottom-0 right-0 size-5 rounded-full bg-primary text-white flex items-center justify-center cursor-pointer shadow hover:bg-primary/90 transition-colors ring-2 ring-white dark:ring-slate-800" title="Change profile photo">
                    <span class="material-symbols-outlined leading-none" style="font-size: 12px; width: 12px; height: 12px;">edit</span>
                </label>
                <input type="file" name="avatar" id="admin-avatar" accept="image/jpeg,image/png,image/webp,image/gif" class="sr-only">
            </div>
            <div class="min-w-0 flex-1">
                <p class="font-bold text-slate-900 dark:text-slate-100">{{ $admin->name }}</p>
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $admin->email }}</p>
                <p class="text-xs text-primary font-medium mt-0.5">Super Admin</p>
                @error('avatar')
                    <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <p class="text-xs text-slate-400 -mt-4 mb-4">JPG, PNG, WebP or GIF. Max 2 MB. Click the pen on your photo to change it.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Display Name</label>
                <input name="name" type="text" value="{{ old('name', $admin->name) }}" required
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Email Address</label>
                <input name="email" type="email" value="{{ old('email', $admin->email) }}" required
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
        </div>
    </section>

    {{-- Portfolio Info (read-only from profile) --}}
    <section class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl p-5 md:p-6">
        <div class="flex items-center justify-between gap-2 mb-5">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">person_pin</span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Portfolio Info</h3>
            </div>
            <a href="{{ route('admin.content') }}" class="text-xs font-bold text-primary hover:underline">Edit in Content →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @php
                $fields = [
                    'Full Name'    => $profile->full_name ?? 'N/A',
                    'Title'        => $profile->title ?? 'N/A',
                    'Email'        => $profile->email ?? 'N/A',
                    'Phone'        => $profile->phone ?? 'N/A',
                    'Location'     => $profile->location ?? 'N/A',
                    'Availability' => $profile->availability ?? 'N/A',
                ];
            @endphp
            @foreach ($fields as $label => $val)
                <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg px-4 py-3">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $label }}</p>
                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100 mt-0.5">{{ $val }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Change Password --}}
    <section class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl p-5 md:p-6">
        <div class="flex items-center gap-2 mb-5">
            <span class="material-symbols-outlined text-primary">lock</span>
            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Change Password</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Current Password</label>
                <input name="current_password" type="password"
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">New Password</label>
                <input name="new_password" type="password"
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Confirm New Password</label>
                <input name="new_password_confirmation" type="password"
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
        </div>
        <p class="text-xs text-slate-400 dark:text-slate-600 mt-2">Leave blank to keep your current password.</p>
    </section>

    <div class="flex justify-end">
        <button type="submit"
                class="px-6 py-2.5 text-sm font-bold bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-sm align-middle">save</span> Save Settings
        </button>
    </div>
</form>

@endsection

@push('scripts')
<script>
document.getElementById('admin-avatar')?.addEventListener('change', function(e) {
    var file = e.target.files?.[0];
    if (file) {
        document.getElementById('admin-avatar-preview').src = URL.createObjectURL(file);
    }
});
setTimeout(function() { var f = document.getElementById('flash-msg'); if (f) f.style.display = 'none'; }, 4000);
</script>
@endpush
