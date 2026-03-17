<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'type', 'school_name', 'year', 'description', 'sort_order',
    ];

    public const TYPES = ['primary', 'secondary', 'college'];
}
