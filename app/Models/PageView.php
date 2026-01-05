<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'session_id',
        'ip_address',
        'country',
        'city',
        'user_agent',
        'device_type',
        'browser',
        'platform',
        'url',
        'page_title',
        'referrer',
        'time_on_page',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function session()
    {
        return $this->belongsTo(VisitorSession::class, 'session_id', 'session_id');
    }
}
