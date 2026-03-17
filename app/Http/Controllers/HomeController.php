<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\PageView;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SkillCategory;
use App\Models\Stat;

class HomeController extends Controller
{
    public function index()
    {
        // Track page view
        PageView::create(['page' => '/', 'ip_address' => request()->ip()]);

        $profile   = Profile::first();
        $stats     = Stat::where('is_visible', true)->orderBy('sort_order')->get();
        $projects  = Project::where('is_visible', true)->where('is_featured', true)->orderBy('sort_order')->take(4)->get();
        $allProjects = Project::where('is_visible', true)->orderBy('sort_order')->get();
        $skillCategories = SkillCategory::with(['skills' => fn($q) => $q->where('is_visible', true)->orderBy('sort_order')])->orderBy('sort_order')->get();
        $educations = Education::orderBy('sort_order')->orderBy('type')->get();

        return view('home', compact('profile', 'stats', 'projects', 'allProjects', 'skillCategories', 'educations'));
    }
}
