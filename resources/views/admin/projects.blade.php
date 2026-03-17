@extends('admin.layouts.app')

@section('title', 'Portfolio - Admin Projects')
@section('header', 'Projects')

@section('content')

@if (session('success'))
    <div id="flash-msg" class="flex items-center gap-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">check_circle</span> {{ session('success') }}
    </div>
@endif

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <div>
        <h1 class="text-xl md:text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Projects</h1>
        <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm">Overview of all ongoing and archived initiatives</p>
    </div>
    <button onclick="openProjectModal()" type="button"
            class="inline-flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-lg font-bold text-sm hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 shrink-0">
        <span class="material-symbols-outlined text-lg">add</span> Add New Project
    </button>
</div>

{{-- Tabs --}}
<div id="tab-bar" class="flex border-b border-slate-200 dark:border-slate-800 overflow-x-auto">
    <button onclick="showTab('all')" id="tab-all"
            class="tab-btn px-6 py-3 text-sm font-bold border-b-2 border-primary text-primary whitespace-nowrap">
        All Projects ({{ $projects->count() }})
    </button>
    <button onclick="showTab('archived')" id="tab-archived"
            class="tab-btn px-6 py-3 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 whitespace-nowrap">
        Archived ({{ $archived->count() }})
    </button>
</div>

{{-- All Projects Grid --}}
<div id="panel-all">
    @if ($projects->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-slate-400 dark:text-slate-600">
            <span class="material-symbols-outlined text-6xl mb-3">work_off</span>
            <p class="font-bold">No projects yet.</p>
            <p class="text-sm">Click "Add New Project" to get started.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($projects as $project)
                <div class="group bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                    <div class="h-36 bg-slate-200 dark:bg-slate-700 relative overflow-hidden">
                        @if ($project->thumbnail_path)
                            <img src="{{ asset($project->thumbnail_path) }}" alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-primary/30 to-blue-600/30 flex items-center justify-center">
                                <span class="material-symbols-outlined text-5xl text-white/50">work</span>
                            </div>
                        @endif
                        @if ($project->category)
                            <div class="absolute top-3 left-3 bg-white/90 dark:bg-slate-900/90 backdrop-blur px-2.5 py-1 rounded text-[10px] font-bold uppercase tracking-wider">
                                {{ $project->category }}
                            </div>
                        @endif
                        @if ($project->is_featured)
                            <div class="absolute top-3 right-3 bg-amber-400 text-white px-2 py-0.5 rounded text-[10px] font-bold">Featured</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-base font-bold group-hover:text-primary transition-colors text-slate-900 dark:text-slate-100">{{ $project->title }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">{{ $project->short_desc ?? $project->description ?? 'No description.' }}</p>
                        <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <div class="flex gap-1">
                                <button onclick="openEditModal({{ $project->id }})" type="button"
                                        class="p-2 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </button>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                      onsubmit="return confirm('Archive this project?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-all" title="Archive">
                                        <span class="material-symbols-outlined text-xl">archive</span>
                                    </button>
                                </form>
                            </div>
                            <span class="text-[10px] text-slate-400">{{ $project->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    {{-- Hidden edit data --}}
                    <script type="application/json" id="project-data-{{ $project->id }}">
                        {!! json_encode([
                            'id'           => $project->id,
                            'title'        => $project->title,
                            'category'     => $project->category,
                            'short_desc'   => $project->short_desc,
                            'description'  => $project->description,
                            'demo_url'     => $project->demo_url,
                            'repo_url'     => $project->repo_url,
                            'is_featured'  => $project->is_featured,
                            'is_visible'   => $project->is_visible,
                            'completed_at' => $project->completed_at?->format('Y-m-d'),
                        ]) !!}
                    </script>
                </div>
            @endforeach

            {{-- Add placeholder --}}
            <button onclick="openProjectModal()" type="button"
                    class="group border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-xl flex flex-col items-center justify-center p-8 hover:bg-primary/5 hover:border-primary/50 transition-all min-h-[240px]">
                <div class="size-14 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-400 group-hover:text-primary group-hover:bg-primary/10 transition-all mb-3">
                    <span class="material-symbols-outlined text-4xl">add_circle</span>
                </div>
                <p class="font-bold text-slate-500 dark:text-slate-400 group-hover:text-primary transition-colors text-sm">Add New Project</p>
            </button>
        </div>
    @endif
</div>

{{-- Archived Grid --}}
<div id="panel-archived" class="hidden">
    @if ($archived->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-slate-400 dark:text-slate-600">
            <span class="material-symbols-outlined text-6xl mb-3">inventory_2</span>
            <p class="font-bold">No archived projects.</p>
        </div>
    @else
        <div class="flex justify-end mb-3">
            <form method="POST" action="{{ route('admin.projects.clear-archive') }}"
                  onsubmit="return confirm('Permanently delete ALL archived projects? This cannot be undone.')">
                @csrf @method('DELETE')
                <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700 border border-red-200 dark:border-red-800 px-3 py-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                    <span class="material-symbols-outlined text-sm align-middle">delete_sweep</span> Clear Archive
                </button>
            </form>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($archived as $project)
                <div class="bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden opacity-70 hover:opacity-100 transition-opacity">
                    <div class="h-28 bg-slate-200 dark:bg-slate-700 flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-slate-400">archive</span>
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100 line-clamp-1">{{ $project->title }}</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Archived {{ $project->deleted_at->diffForHumans() }}</p>
                        <div class="flex gap-2 mt-3">
                            <form method="POST" action="{{ route('admin.projects.restore', $project->id) }}">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-primary hover:underline">Restore</button>
                            </form>
                            <span class="text-slate-300 dark:text-slate-700">|</span>
                            <form method="POST" action="{{ route('admin.projects.force-delete', $project->id) }}"
                                  onsubmit="return confirm('Permanently delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-red-500 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Add / Edit Project Modal --}}
<div id="project-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-slate-800">
            <h3 id="modal-title" class="text-lg font-bold text-slate-900 dark:text-slate-100">Add New Project</h3>
            <button onclick="closeProjectModal()" type="button" class="p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="project-form" method="POST" enctype="multipart/form-data" class="p-5 flex flex-col gap-4">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Project Title *</label>
                    <input name="title" id="f-title" type="text" required placeholder="e.g. ManPro HRMS"
                           class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Category</label>
                    <input name="category" id="f-category" type="text" placeholder="e.g. Web Application"
                           class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Completed Date</label>
                    <input name="completed_at" id="f-completed" type="date"
                           class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Short Description (for card)</label>
                    <input name="short_desc" id="f-short-desc" type="text" placeholder="One-liner description..."
                           class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Full Description</label>
                    <textarea name="description" id="f-desc" rows="4" placeholder="Detailed project description..."
                              class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none resize-y"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Demo URL</label>
                    <input name="demo_url" id="f-demo" type="url" placeholder="https://..."
                           class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Repository URL</label>
                    <input name="repo_url" id="f-repo" type="url" placeholder="https://github.com/..."
                           class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Thumbnail Image</label>
                    <input name="thumbnail" id="f-thumbnail" type="file" accept="image/*"
                           class="w-full text-sm text-slate-600 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20" />
                </div>
                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input name="is_featured" id="f-featured" type="checkbox" value="1"
                               class="w-4 h-4 rounded text-primary focus:ring-primary/20" />
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Featured</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input name="is_visible" id="f-visible" type="checkbox" value="1" checked
                               class="w-4 h-4 rounded text-primary focus:ring-primary/20" />
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Visible</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-3 border-t border-slate-200 dark:border-slate-800">
                <button onclick="closeProjectModal()" type="button"
                        class="flex-1 py-2.5 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        class="flex-1 py-2.5 text-sm font-bold bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    Save Project
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function showTab(tab) {
    ['all','archived'].forEach(t => {
        document.getElementById(`panel-${t}`).classList.toggle('hidden', t !== tab);
        const btn = document.getElementById(`tab-${t}`);
        btn.className = t === tab
            ? 'tab-btn px-6 py-3 text-sm font-bold border-b-2 border-primary text-primary whitespace-nowrap'
            : 'tab-btn px-6 py-3 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 whitespace-nowrap';
    });
}

function openProjectModal() {
    document.getElementById('modal-title').textContent = 'Add New Project';
    document.getElementById('project-form').action = '{{ route("admin.projects.store") }}';
    document.getElementById('form-method').value = 'POST';
    // Reset fields
    ['f-title','f-category','f-short-desc','f-desc','f-demo','f-repo','f-completed'].forEach(id => {
        document.getElementById(id).value = '';
    });
    document.getElementById('f-featured').checked = false;
    document.getElementById('f-visible').checked = true;
    document.getElementById('project-modal').classList.replace('hidden','flex');
}

function openEditModal(id) {
    const data = JSON.parse(document.getElementById(`project-data-${id}`).textContent);
    document.getElementById('modal-title').textContent = 'Edit Project';
    document.getElementById('project-form').action = `/admin/projects/${id}`;
    document.getElementById('form-method').value = 'PUT';
    document.getElementById('f-title').value       = data.title || '';
    document.getElementById('f-category').value    = data.category || '';
    document.getElementById('f-short-desc').value  = data.short_desc || '';
    document.getElementById('f-desc').value        = data.description || '';
    document.getElementById('f-demo').value        = data.demo_url || '';
    document.getElementById('f-repo').value        = data.repo_url || '';
    document.getElementById('f-completed').value   = data.completed_at || '';
    document.getElementById('f-featured').checked  = !!data.is_featured;
    document.getElementById('f-visible').checked   = !!data.is_visible;
    document.getElementById('project-modal').classList.replace('hidden','flex');
}

function closeProjectModal() {
    document.getElementById('project-modal').classList.replace('flex','hidden');
}

setTimeout(() => { const f = document.getElementById('flash-msg'); if(f) f.style.display='none'; }, 4000);
</script>
@endpush
