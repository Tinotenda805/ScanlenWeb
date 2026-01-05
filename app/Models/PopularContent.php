<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularContent extends Model
{
    protected $table = 'popular_content';
    
    protected $fillable = [
        'content_type',
        'content_id',
        'content_title',
        'view_count',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
