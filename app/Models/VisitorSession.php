<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorSession extends Model
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
        'landing_page',
        'exit_page',
        'total_pages_viewed',
        'total_time_spent',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function pageViews()
    {
        return $this->hasMany(PageView::class, 'session_id', 'session_id');
    }

    public function clickEvents()
    {
        return $this->hasMany(ClickEvent::class, 'session_id', 'session_id');
    }

    public function getAverageTimePerPageAttribute()
    {
        if ($this->total_pages_viewed == 0) return 0;
        return round($this->total_time_spent / $this->total_pages_viewed);
    }

    public function getSessionDurationAttribute()
    {
        if (!$this->ended_at) return 0;
        return $this->started_at->diffInSeconds($this->ended_at);
    }
}
