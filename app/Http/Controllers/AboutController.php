<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\PageView;
use App\Models\Profile;
use App\Models\SkillCategory;
use App\Models\SocialLink;

class AboutController extends Controller
{
    public function index()
    {
        PageView::create(['page' => '/about', 'ip_address' => request()->ip()]);
        $profile         = Profile::first();
        $skillCategories = SkillCategory::with(['skills' => fn($q) => $q->where('is_visible', true)->orderBy('sort_order')])->orderBy('sort_order')->get();
        $socialLinks     = SocialLink::where('is_visible', true)->orderBy('sort_order')->get();
        $educations      = Education::orderBy('sort_order')->orderBy('type')->get();
        return view('about', compact('profile', 'skillCategories', 'socialLinks', 'educations'));
    }
}
