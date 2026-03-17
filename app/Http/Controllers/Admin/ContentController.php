<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Stat;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $profile        = Profile::first() ?? new Profile();
        $stats          = Stat::orderBy('sort_order')->get()->keyBy('label');
        $skillCategories = SkillCategory::with('skills')->orderBy('sort_order')->get();
        $socialLinks    = SocialLink::orderBy('sort_order')->get();
        $educations     = Education::orderBy('sort_order')->orderBy('type')->get();

        return view('admin.content', compact('profile', 'stats', 'skillCategories', 'socialLinks', 'educations'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name'    => 'required|string|max:150',
            'title'        => 'required|string|max:150',
            'tagline'      => 'nullable|string|max:500',
            'bio'          => 'nullable|string',
            'availability' => 'nullable|string|max:80',
            'email'        => 'nullable|email|max:191',
            'phone'        => 'nullable|string|max:30',
            'location'     => 'nullable|string|max:150',
            'avatar'       => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:2048',
        ], [
            'avatar.image' => 'The profile photo must be an image (JPG, PNG, WebP or GIF).',
            'avatar.max'   => 'The profile photo may not be larger than 2 MB.',
        ]);

        $profileData = [
            'full_name'    => $request->full_name,
            'title'        => $request->title,
            'tagline'      => $request->tagline,
            'bio'          => $request->bio,
            'availability' => $request->availability,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'location'     => $request->location,
        ];

        if ($request->hasFile('avatar')) {
            $dir = public_path('images/profiles');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $file = $request->file('avatar');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'png');
            if (!in_array($ext, ['jpeg', 'jpg', 'png', 'webp', 'gif'], true)) {
                $ext = 'png';
            }
            $filename = 'profile_avatar.' . $ext;
            $file->move($dir, $filename);
            $profileData['avatar_path'] = 'images/profiles/' . $filename;
        }

        // Ensure profile exists and save to database (including avatar_path)
        $profile = Profile::first();
        if (!$profile) {
            $profile = new Profile();
        }
        $profile->fill($profileData);
        $profile->save();

        // Stats (experience, projects, clients, satisfaction)
        $satisfactionRaw = trim((string) ($request->stat_satisfaction ?? ''));
        if ($satisfactionRaw !== '' && !str_ends_with($satisfactionRaw, '%')) {
            $satisfactionRaw = $satisfactionRaw . '%';
        }

        $statsData = [
            ['label' => 'Experience',   'value' => $request->stat_experience,   'icon' => 'schedule',      'sort_order' => 1],
            ['label' => 'Projects',     'value' => $request->stat_projects,     'icon' => 'rocket_launch', 'sort_order' => 2],
            ['label' => 'Clients',      'value' => $request->stat_clients,      'icon' => 'groups',        'sort_order' => 3],
            ['label' => 'Satisfaction', 'value' => $satisfactionRaw,             'icon' => 'thumb_up',      'sort_order' => 4],
        ];

        foreach ($statsData as $s) {
            $value = $s['value'];
            $allowSave = $value !== null && ((string) $value === '0' || trim((string) $value) !== '');
            if ($allowSave) {
                Stat::updateOrCreate(['label' => $s['label']], $s);
            }
        }

        // Social links
        $platforms = ['Email', 'LinkedIn', 'GitHub', 'Discord', 'Facebook'];
        foreach ($platforms as $platform) {
            $key = 'social_' . strtolower($platform);
            $url = $request->$key;
            if ($url) {
                SocialLink::updateOrCreate(['platform' => $platform], [
                    'url'        => $url,
                    'icon'       => match($platform) {
                        'Email'    => 'alternate_email',
                        'LinkedIn' => 'groups',
                        'GitHub'   => 'code',
                        'Discord'  => 'chat_bubble',
                        'Facebook' => 'share',
                        default    => 'link',
                    },
                    'is_visible' => true,
                    'sort_order' => array_search($platform, $platforms) + 1,
                ]);
            }
        }

        return redirect()->route('admin.content')->with('success', 'Content saved successfully!');
    }

    public function addSkill(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:100',
            'skill_category_id' => 'required|exists:skill_categories,id',
            'proficiency'       => 'nullable|integer|min:0|max:100',
        ]);

        $skill = Skill::create([
            'skill_category_id' => $request->skill_category_id,
            'name'              => $request->name,
            'proficiency'       => $request->proficiency ?? 80,
            'sort_order'        => Skill::where('skill_category_id', $request->skill_category_id)->max('sort_order') + 1,
            'is_visible'        => true,
        ]);

        return response()->json(['success' => true, 'skill' => $skill]);
    }

    public function deleteSkill(Skill $skill)
    {
        $skill->delete();
        return response()->json(['success' => true]);
    }

    public function addEducation(Request $request)
    {
        $request->validate([
            'type'        => 'required|in:primary,secondary,college',
            'school_name' => 'required|string|max:255',
            'year'        => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
        ]);

        $education = Education::create([
            'type'        => $request->type,
            'school_name' => $request->school_name,
            'year'        => $request->year,
            'description' => $request->description,
            'sort_order'  => Education::max('sort_order') + 1,
        ]);

        return response()->json(['success' => true, 'education' => $education]);
    }

    public function deleteEducation(Education $education)
    {
        $education->delete();
        return response()->json(['success' => true]);
    }
}
