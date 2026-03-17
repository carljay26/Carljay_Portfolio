@extends('admin.layouts.app')

@section('title', 'Portfolio - Admin Content')
@section('header', 'Content Management')

@section('content')

@if (session('success'))
    <div id="flash-msg" class="flex items-center gap-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 rounded-xl px-4 py-3 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">check_circle</span>
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="flex items-start gap-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 rounded-xl px-4 py-3 text-sm font-medium mb-4">
        <span class="material-symbols-outlined text-lg shrink-0">error</span>
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Page header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
    <div>
        <h1 class="text-xl md:text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Content Management</h1>
        <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm">Update your bio, home section, skills, and social links</p>
    </div>
    <div class="flex items-center gap-2 shrink-0">
        <a href="{{ url('/') }}" target="_blank" rel="noopener"
           class="px-4 py-2 text-sm font-medium border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
            Preview Site
        </a>
        <button id="edit-btn" type="button" onclick="enableEdit()"
                class="px-4 py-2 text-sm font-medium bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-sm align-middle">edit</span> Edit
        </button>
        <button id="save-btn" type="submit" form="content-form"
                class="hidden px-4 py-2 text-sm font-medium bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-600/20">
            <span class="material-symbols-outlined text-sm align-middle">save</span> Save Changes
        </button>
        <button id="cancel-btn" type="button" onclick="disableEdit()"
                class="hidden px-4 py-2 text-sm font-medium border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
            Cancel
        </button>
    </div>
</div>

{{-- Lock overlay (shown by default when not editing) --}}
<div id="lock-overlay" class="fixed inset-0 z-20 bg-transparent pointer-events-none"></div>

<form id="content-form" method="POST" action="{{ route('admin.content.update') }}" class="flex flex-col gap-5" enctype="multipart/form-data">
    @csrf

    {{-- Fieldset: locked until Edit is clicked --}}
    <fieldset id="form-fields" disabled class="flex flex-col gap-5 transition-opacity duration-200">

        {{-- Profile (photo + text) --}}
        <section class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl p-4 md:p-6">
            <div class="flex items-center gap-2 mb-5">
                <span class="material-symbols-outlined text-primary">campaign</span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Profile</h3>
            </div>
            {{-- Profile photo – same lock as other fields --}}
            <div class="mb-6">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Profile Photo</label>
                <div class="flex flex-wrap items-end gap-4">
                    <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-200 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 shrink-0">
                        <img id="avatar-preview" src="{{ $profile?->avatar_path ? asset($profile->avatar_path) : asset('images/portfoliologo.png') }}" alt="Profile" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-1">
                        <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/webp,image/gif"
                               class="text-sm text-slate-600 dark:text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-white file:font-medium file:cursor-pointer hover:file:bg-primary/90 disabled:opacity-60 disabled:pointer-events-none">
                        <p class="text-xs text-slate-400">Click Edit to change. JPG, PNG, WebP or GIF. Max 2 MB.</p>
                        @error('avatar')
                            <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php $p = $profile; @endphp
                <x-admin.field label="Full Name"            name="full_name"    :value="$p->full_name ?? ''" />
                <x-admin.field label="Professional Title"   name="title"        :value="$p->title ?? ''" />
                <x-admin.field label="Availability Status"  name="availability" :value="$p->availability ?? 'Available for work'" />
                <x-admin.field label="Location"             name="location"     :value="$p->location ?? ''" />
                <x-admin.field label="Email"                name="email"        type="email" :value="$p->email ?? ''" />
                <x-admin.field label="Phone"                name="phone"        :value="$p->phone ?? ''" />
                <div class="md:col-span-2">
                    <x-admin.field label="Tagline (short)" name="tagline" type="textarea" :value="$p->tagline ?? ''" rows="2" />
                </div>
                <div class="md:col-span-2">
                    <x-admin.field label="Bio / About Me"  name="bio"     type="textarea" :value="$p->bio ?? ''" rows="5" />
                </div>
            </div>
        </section>

        {{-- Stats --}}
        <section class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl p-4 md:p-6">
            <div class="flex items-center gap-2 mb-5">
                <span class="material-symbols-outlined text-primary">bar_chart</span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Portfolio Stats</h3>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <x-admin.field label="Experience"   name="stat_experience"   :value="$stats['Experience']->value   ?? ''" placeholder="e.g. 5+ Years" />
                <x-admin.field label="Projects"     name="stat_projects"     :value="$stats['Projects']->value     ?? ''" placeholder="e.g. 40+ Done" />
                <x-admin.field label="Clients"      name="stat_clients"      :value="$stats['Clients']->value      ?? ''" placeholder="e.g. 25+ Global" />
                <x-admin.field label="Satisfaction" name="stat_satisfaction" :value="$stats['Satisfaction']->value ?? ''" placeholder="e.g. 100%" />
            </div>
        </section>

        {{-- Technical Skills --}}
        <section class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl p-4 md:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">terminal</span>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Technical Skills</h3>
                </div>
                <button type="button" id="add-skill-btn" onclick="openSkillModal()"
                        class="skill-action flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors cursor-not-allowed opacity-40">
                    <span class="material-symbols-outlined text-sm">add</span> Add Skill
                </button>
            </div>

            @foreach ($skillCategories as $cat)
                <div class="mb-4">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">{{ $cat->name }}</p>
                    <div class="flex flex-wrap gap-2" id="skills-cat-{{ $cat->id }}">
                        @foreach ($cat->skills as $skill)
                            <div class="skill-tag flex items-center gap-2 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-3 py-1.5 rounded-lg" data-skill-id="{{ $skill->id }}">
                                <span class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $skill->name }}</span>
                                <button type="button" onclick="deleteSkill({{ $skill->id }}, this)"
                                        class="skill-action text-slate-400 hover:text-red-500 transition-colors cursor-not-allowed opacity-0 pointer-events-none" aria-label="Remove skill">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>

        {{-- Social Links --}}
        <section class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl p-4 md:p-6">
            <div class="flex items-center gap-2 mb-5">
                <span class="material-symbols-outlined text-primary">share</span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Social Links</h3>
            </div>
            @php
                $socials = $socialLinks->keyBy('platform');
                $platforms = [
                    ['key'=>'Email',    'label'=>'Email (mailto:)',  'placeholder'=>'mailto:you@email.com'],
                    ['key'=>'LinkedIn', 'label'=>'LinkedIn URL',     'placeholder'=>'https://linkedin.com/in/...'],
                    ['key'=>'GitHub',   'label'=>'GitHub URL',       'placeholder'=>'https://github.com/...'],
                    ['key'=>'Discord',  'label'=>'Discord Invite',   'placeholder'=>'https://discord.gg/...'],
                    ['key'=>'Facebook', 'label'=>'Facebook URL',     'placeholder'=>'https://facebook.com/...'],
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($platforms as $pl)
                    <x-admin.field :label="$pl['label']" :name="'social_'.strtolower($pl['key'])"
                                   :value="$socials[$pl['key']]->url ?? ''" :placeholder="$pl['placeholder']" />
                @endforeach
            </div>
        </section>

        {{-- Education --}}
        <section class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl p-4 md:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">school</span>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Education</h3>
                </div>
                <button type="button" id="add-education-btn" onclick="openEducationModal()"
                        class="education-action flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors cursor-not-allowed opacity-40">
                    <span class="material-symbols-outlined text-sm">add</span> Add Education
                </button>
            </div>

            @if ($educations->isEmpty())
                <p class="text-sm text-slate-500 dark:text-slate-400">No education entries yet. Click "Add Education" to add Primary, Secondary, or College.</p>
            @else
                <div class="space-y-3" id="education-list">
                    @foreach ($educations as $edu)
                        <div class="education-item flex items-center justify-between gap-4 p-3 rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700" data-education-id="{{ $edu->id }}">
                            <div class="flex-1 min-w-0">
                                <span class="inline-block px-2 py-0.5 rounded text-xs font-bold uppercase {{ $edu->type === 'primary' ? 'bg-amber-500/20 text-amber-600' : ($edu->type === 'secondary' ? 'bg-blue-500/20 text-blue-600' : 'bg-primary/20 text-primary') }}">{{ ucfirst($edu->type) }}</span>
                                <span class="font-medium text-slate-900 dark:text-slate-100 ml-2">{{ $edu->school_name }}</span>
                                <span class="text-slate-500 dark:text-slate-400 text-sm ml-2">({{ $edu->year }})</span>
                            </div>
                            <button type="button" onclick="deleteEducation({{ $edu->id }}, this)"
                                    class="education-action text-slate-400 hover:text-red-500 transition-colors cursor-not-allowed opacity-0 pointer-events-none shrink-0" aria-label="Remove education">
                                <span class="material-symbols-outlined text-sm">close</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

    </fieldset>
</form>

{{-- Add Education Modal --}}
<div id="education-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 w-full max-w-sm mx-4 shadow-2xl">
        <h3 class="text-lg font-bold mb-4 text-slate-900 dark:text-slate-100">Add Education</h3>
        <div class="flex flex-col gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Level</label>
                <select id="edu-modal-type" class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none">
                    <option value="primary">Primary</option>
                    <option value="secondary">Secondary</option>
                    <option value="college">College</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">School Name</label>
                <input id="edu-modal-school" type="text" placeholder="e.g. University of Example"
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Year</label>
                <input id="edu-modal-year" type="text" placeholder="e.g. 2015 or 2015-2019"
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Description (optional)</label>
                <input id="edu-modal-desc" type="text" placeholder="e.g. Bachelor of Science in Computer Science"
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
        </div>
        <div class="flex gap-3 mt-5">
            <button onclick="closeEducationModal()" type="button"
                    class="flex-1 py-2.5 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                Cancel
            </button>
            <button onclick="submitEducation()" type="button"
                    class="flex-1 py-2.5 text-sm font-bold bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                Add Education
            </button>
        </div>
    </div>
</div>

{{-- Add Skill Modal --}}
<div id="skill-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 w-full max-w-sm mx-4 shadow-2xl">
        <h3 class="text-lg font-bold mb-4 text-slate-900 dark:text-slate-100">Add Skill</h3>
        <div class="flex flex-col gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Category</label>
                <select id="modal-cat" class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none">
                    @foreach ($skillCategories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Skill Name</label>
                <input id="modal-name" type="text" placeholder="e.g. TypeScript"
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Proficiency (0–100)</label>
                <input id="modal-prof" type="number" min="0" max="100" value="80"
                       class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-slate-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
        </div>
        <div class="flex gap-3 mt-5">
            <button onclick="closeSkillModal()" type="button"
                    class="flex-1 py-2.5 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                Cancel
            </button>
            <button onclick="submitSkill()" type="button"
                    class="flex-1 py-2.5 text-sm font-bold bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                Add Skill
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const isEditing = false;

function enableEdit() {
    document.getElementById('form-fields').disabled = false;
    document.getElementById('edit-btn').classList.add('hidden');
    document.getElementById('save-btn').classList.remove('hidden');
    document.getElementById('cancel-btn').classList.remove('hidden');
    // Show skill delete buttons and add-skill button
    document.querySelectorAll('.skill-action').forEach(el => {
        el.classList.remove('cursor-not-allowed','opacity-0','opacity-40','pointer-events-none');
    });
    // Show education delete buttons and add-education button
    document.querySelectorAll('.education-action').forEach(el => {
        el.classList.remove('cursor-not-allowed','opacity-0','opacity-40','pointer-events-none');
    });
}

function disableEdit() {
    document.getElementById('form-fields').disabled = true;
    document.getElementById('edit-btn').classList.remove('hidden');
    document.getElementById('save-btn').classList.add('hidden');
    document.getElementById('cancel-btn').classList.add('hidden');
    document.querySelectorAll('.skill-action').forEach(el => {
        el.classList.add('cursor-not-allowed');
        if (el.id === 'add-skill-btn') el.classList.add('opacity-40');
        else el.classList.add('opacity-0','pointer-events-none');
    });
    document.querySelectorAll('.education-action').forEach(el => {
        el.classList.add('cursor-not-allowed');
        if (el.id === 'add-education-btn') el.classList.add('opacity-40');
        else el.classList.add('opacity-0','pointer-events-none');
    });
}

function openSkillModal() {
    document.getElementById('skill-modal').classList.replace('hidden','flex');
}
function closeSkillModal() {
    document.getElementById('skill-modal').classList.replace('flex','hidden');
}

function submitSkill() {
    const catId = document.getElementById('modal-cat').value;
    const name  = document.getElementById('modal-name').value.trim();
    const prof  = document.getElementById('modal-prof').value;
    if (!name) { alert('Please enter a skill name.'); return; }

    fetch('{{ route("admin.skills.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ skill_category_id: catId, name, proficiency: prof }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const container = document.getElementById(`skills-cat-${catId}`);
            const div = document.createElement('div');
            div.className = 'skill-tag flex items-center gap-2 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-3 py-1.5 rounded-lg';
            div.dataset.skillId = data.skill.id;
            div.innerHTML = `<span class="text-sm font-medium text-slate-900 dark:text-slate-100">${name}</span>
                <button type="button" onclick="deleteSkill(${data.skill.id}, this)" class="skill-action text-slate-400 hover:text-red-500 transition-colors" aria-label="Remove skill">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>`;
            container.appendChild(div);
            closeSkillModal();
            document.getElementById('modal-name').value = '';
        }
    });
}

function deleteSkill(id, btn) {
    if (!confirm('Remove this skill?')) return;
    fetch(`{{ url('admin/skills') }}/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.closest('.skill-tag').remove();
        }
    });
}

function openEducationModal() {
    document.getElementById('education-modal').classList.replace('hidden','flex');
}
function closeEducationModal() {
    document.getElementById('education-modal').classList.replace('flex','hidden');
}

function submitEducation() {
    const type = document.getElementById('edu-modal-type').value;
    const school = document.getElementById('edu-modal-school').value.trim();
    const year = document.getElementById('edu-modal-year').value.trim();
    const desc = document.getElementById('edu-modal-desc').value.trim();
    if (!school || !year) { alert('Please enter school name and year.'); return; }

    fetch('{{ route("admin.education.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ type, school_name: school, year, description: desc || null }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            let listEl = document.getElementById('education-list');
            if (!listEl) {
                const section = document.getElementById('add-education-btn')?.closest('section');
                const emptyMsg = section?.querySelector('.text-slate-500');
                if (emptyMsg) emptyMsg.remove();
                listEl = document.createElement('div');
                listEl.id = 'education-list';
                listEl.className = 'space-y-3';
                section?.appendChild(listEl);
            }
            const item = document.createElement('div');
            item.className = 'education-item flex items-center justify-between gap-4 p-3 rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700';
            item.dataset.educationId = data.education.id;
            const typeClass = type === 'primary' ? 'bg-amber-500/20 text-amber-600' : (type === 'secondary' ? 'bg-blue-500/20 text-blue-600' : 'bg-primary/20 text-primary');
            item.innerHTML = `<div class="flex-1 min-w-0">
                <span class="inline-block px-2 py-0.5 rounded text-xs font-bold uppercase ${typeClass}">${type.charAt(0).toUpperCase() + type.slice(1)}</span>
                <span class="font-medium text-slate-900 dark:text-slate-100 ml-2">${school}</span>
                <span class="text-slate-500 dark:text-slate-400 text-sm ml-2">(${year})</span>
            </div>
            <button type="button" onclick="deleteEducation(${data.education.id}, this)" class="education-action text-slate-400 hover:text-red-500 transition-colors shrink-0" aria-label="Remove education">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>`;
            listEl.appendChild(item);
            closeEducationModal();
            document.getElementById('edu-modal-school').value = '';
            document.getElementById('edu-modal-year').value = '';
            document.getElementById('edu-modal-desc').value = '';
        }
    });
}

function deleteEducation(id, btn) {
    if (!confirm('Remove this education entry?')) return;
    fetch(`{{ url('admin/education') }}/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.closest('.education-item').remove();
        }
    });
}

// Avatar file preview
document.getElementById('avatar')?.addEventListener('change', function(e) {
    const file = e.target.files?.[0];
    const img = document.getElementById('avatar-preview');
    if (file && img) {
        img.src = URL.createObjectURL(file);
    }
});

// Auto-dismiss flash
setTimeout(() => {
    const f = document.getElementById('flash-msg');
    if (f) f.style.display = 'none';
}, 4000);
</script>
@endpush
