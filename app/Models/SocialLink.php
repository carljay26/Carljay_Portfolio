<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $table = 'social_links';

    protected $fillable = ['platform', 'url', 'icon', 'sort_order', 'is_visible'];

    protected $casts = ['is_visible' => 'boolean'];
}
