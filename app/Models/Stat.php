<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table = 'stats';

    protected $fillable = ['label', 'value', 'icon', 'sort_order', 'is_visible'];

    protected $casts = ['is_visible' => 'boolean'];
}
