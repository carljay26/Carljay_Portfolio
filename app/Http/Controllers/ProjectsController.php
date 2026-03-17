<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use App\Models\Project;
use App\Models\Profile;

class ProjectsController extends Controller
{
    public function index()
    {
        PageView::create(['page' => '/projects', 'ip_address' => request()->ip()]);
        $projects = Project::where('is_visible', true)->orderBy('sort_order')->get();
        $profile  = Profile::first();
        return view('projects', compact('projects', 'profile'));
    }
}
