<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Admin (password: Admin@1234)
        DB::table('admins')->insert([
            'name' => 'Carl Jay Cocamas',
            'email' => 'carljay@portfolio.local',
            'password' => Hash::make('Admin@1234'),
            'is_super_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Profile
        DB::table('profile')->insert([
            'full_name' => 'Carl Jay Cocamas',
            'title' => 'Full Stack Developer',
            'tagline' => 'Building scalable web applications from front-end to back-end.',
            'bio' => 'Focused on clean architecture, performance, and creating seamless user experiences. Passionate about turning ideas into polished digital products.',
            'availability' => 'Available for work',
            'avatar_path' => 'images/Profile.png',
            'email' => 'carljay@portfolio.local',
            'location' => 'Philippines',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Stats
        DB::table('stats')->insert([
            ['label' => 'Experience', 'value' => '5+ Years', 'icon' => 'schedule', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Projects', 'value' => '40+ Done', 'icon' => 'rocket_launch', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Clients', 'value' => '25+ Global', 'icon' => 'groups', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Satisfaction', 'value' => '100%', 'icon' => 'thumb_up', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Social links
        DB::table('social_links')->insert([
            ['platform' => 'Email', 'url' => 'mailto:carljay@portfolio.local', 'icon' => 'alternate_email', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/carljaycocamas', 'icon' => 'groups', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['platform' => 'GitHub', 'url' => 'https://github.com/carljaycocamas', 'icon' => 'code', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Skill categories
        DB::table('skill_categories')->insert([
            ['name' => 'Frontend', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Backend', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Database', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DevOps & Tools', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mobile', 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Skills (ids 1–23 to match project_skills references)
        $skills = [
            ['skill_category_id' => 1, 'name' => 'HTML5 / CSS3', 'proficiency' => 95, 'sort_order' => 1],
            ['skill_category_id' => 1, 'name' => 'JavaScript', 'proficiency' => 90, 'sort_order' => 2],
            ['skill_category_id' => 1, 'name' => 'Vue.js', 'proficiency' => 85, 'sort_order' => 3],
            ['skill_category_id' => 1, 'name' => 'React', 'proficiency' => 80, 'sort_order' => 4],
            ['skill_category_id' => 1, 'name' => 'Tailwind CSS', 'proficiency' => 90, 'sort_order' => 5],
            ['skill_category_id' => 1, 'name' => 'Bootstrap', 'proficiency' => 88, 'sort_order' => 6],
            ['skill_category_id' => 2, 'name' => 'PHP', 'proficiency' => 95, 'sort_order' => 1],
            ['skill_category_id' => 2, 'name' => 'Laravel', 'proficiency' => 92, 'sort_order' => 2],
            ['skill_category_id' => 2, 'name' => 'Node.js', 'proficiency' => 78, 'sort_order' => 3],
            ['skill_category_id' => 2, 'name' => 'REST API', 'proficiency' => 90, 'sort_order' => 4],
            ['skill_category_id' => 2, 'name' => 'GraphQL', 'proficiency' => 70, 'sort_order' => 5],
            ['skill_category_id' => 3, 'name' => 'MySQL', 'proficiency' => 90, 'sort_order' => 1],
            ['skill_category_id' => 3, 'name' => 'SQLite', 'proficiency' => 80, 'sort_order' => 2],
            ['skill_category_id' => 3, 'name' => 'PostgreSQL', 'proficiency' => 72, 'sort_order' => 3],
            ['skill_category_id' => 3, 'name' => 'Redis', 'proficiency' => 68, 'sort_order' => 4],
            ['skill_category_id' => 4, 'name' => 'Git / GitHub', 'proficiency' => 92, 'sort_order' => 1],
            ['skill_category_id' => 4, 'name' => 'Docker', 'proficiency' => 70, 'sort_order' => 2],
            ['skill_category_id' => 4, 'name' => 'Linux / CLI', 'proficiency' => 78, 'sort_order' => 3],
            ['skill_category_id' => 4, 'name' => 'Vite', 'proficiency' => 85, 'sort_order' => 4],
            ['skill_category_id' => 4, 'name' => 'Figma', 'proficiency' => 75, 'sort_order' => 5],
            ['skill_category_id' => 5, 'name' => 'Flutter', 'proficiency' => 72, 'sort_order' => 1],
            ['skill_category_id' => 5, 'name' => 'Android (Java)', 'proficiency' => 65, 'sort_order' => 2],
        ];
        foreach ($skills as $s) {
            DB::table('skills')->insert(array_merge($s, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Projects
        DB::table('projects')->insert([
            [
                'title' => "Think'C",
                'slug' => 'thinkc',
                'category' => 'Game Application',
                'short_desc' => '2D Gamified Learning Application for Elementary Students from Grade 4–6.',
                'description' => "Think'C is an interactive 2D gamified learning application designed to make mathematics and science engaging for elementary students (Grades 4–6). It features mini-games, progress tracking, and a teacher dashboard. Built with Unity and a Laravel REST API backend.",
                'thumbnail_path' => 'images/projects/thinkc-thumbnail.png',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                'completed_at' => '2024-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ManPro',
                'slug' => 'manpro',
                'category' => 'HRMS',
                'short_desc' => 'ManPro is a software system that helps organizations manage data, operations, and workflows efficiently.',
                'description' => 'ManPro (Management Pro) is a comprehensive Human Resource Management System (HRMS) that automates employee records, payroll, attendance, leave management, and reporting. Built with Laravel and Vue.js, it provides role-based access and a modern dashboard.',
                'thumbnail_path' => 'images/projects/manpro-thumbnail.png',
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => 2,
                'completed_at' => '2024-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Portfolio Website',
                'slug' => 'portfolio-website',
                'category' => 'Web Application',
                'short_desc' => 'Personal portfolio website showcasing projects, skills, and professional experience.',
                'description' => 'A fully responsive, dark-mode supported personal portfolio built with Laravel and Tailwind CSS. Features an admin panel for dynamic content management, project showcasing, and a contact form.',
                'thumbnail_path' => 'images/projects/portfolio-thumbnail.png',
                'is_featured' => false,
                'is_visible' => true,
                'sort_order' => 3,
                'completed_at' => '2025-03-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Project ↔ Skills (project_id 1,2,3 and skill ids from above)
        DB::table('project_skills')->insert([
            ['project_id' => 1, 'skill_id' => 7], ['project_id' => 1, 'skill_id' => 8], ['project_id' => 1, 'skill_id' => 2], ['project_id' => 1, 'skill_id' => 1], ['project_id' => 1, 'skill_id' => 12], ['project_id' => 1, 'skill_id' => 16],
            ['project_id' => 2, 'skill_id' => 7], ['project_id' => 2, 'skill_id' => 8], ['project_id' => 2, 'skill_id' => 3], ['project_id' => 2, 'skill_id' => 5], ['project_id' => 2, 'skill_id' => 12], ['project_id' => 2, 'skill_id' => 16],
            ['project_id' => 3, 'skill_id' => 7], ['project_id' => 3, 'skill_id' => 8], ['project_id' => 3, 'skill_id' => 5], ['project_id' => 3, 'skill_id' => 12], ['project_id' => 3, 'skill_id' => 19],
        ]);

        // Sample contact message
        DB::table('contact_messages')->insert([
            'name' => 'Sample Recruiter',
            'email' => 'recruiter@example.com',
            'subject' => 'Project Inquiry',
            'message' => 'Hi Carl, I came across your portfolio and I am impressed with your work. I would love to discuss a potential collaboration.',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
