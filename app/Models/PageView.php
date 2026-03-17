<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $table = 'page_views';

    public $timestamps = false;

    protected $fillable = ['page', 'ip_address', 'viewed_at'];

    protected $casts = ['viewed_at' => 'datetime'];
}
