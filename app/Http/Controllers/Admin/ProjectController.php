<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        $archived = Project::onlyTrashed()->latest('deleted_at')->get();
        return view('admin.projects', compact('projects', 'archived'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
        $data['thumbnail_path'] = $this->handleThumbnail($request);
        Project::create($data);
        return back()->with('success', 'Project added!');
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $this->handleThumbnail($request);
        }
        $project->update($data);
        return back()->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project archived.');
    }

    public function restore(int $id)
    {
        Project::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Project restored.');
    }

    public function forceDelete(int $id)
    {
        Project::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Project permanently deleted.');
    }

    public function clearArchive()
    {
        Project::onlyTrashed()->forceDelete();
        return back()->with('success', 'Archive cleared.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'        => 'required|string|max:200',
            'category'     => 'nullable|string|max:100',
            'short_desc'   => 'nullable|string|max:300',
            'description'  => 'nullable|string',
            'demo_url'     => 'nullable|url|max:500',
            'repo_url'     => 'nullable|url|max:500',
            'is_featured'  => 'nullable|boolean',
            'is_visible'   => 'nullable|boolean',
            'completed_at' => 'nullable|date',
        ]);
    }

    private function handleThumbnail(Request $request): ?string
    {
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('projects', 'public');
            return 'storage/' . $path;
        }
        return null;
    }
}
