<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'full_name', 'title', 'tagline', 'bio',
        'availability', 'avatar_path', 'resume_path',
        'email', 'phone', 'location', 'hire_me_url',
    ];
}
