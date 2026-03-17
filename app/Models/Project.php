<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'title', 'slug', 'category', 'short_desc', 'description',
        'thumbnail_path', 'demo_url', 'repo_url',
        'is_featured', 'is_visible', 'sort_order', 'completed_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible'  => 'boolean',
        'completed_at' => 'date',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skills');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }
}
