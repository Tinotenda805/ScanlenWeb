<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class HistoryTimeline extends Model
{

    use HasFactory, SoftDeletes;

    // protected $table = 'history_timelines';


    protected $fillable = [
        'uuid',
        'decade',
        'title',
        'description',
        'highlights',
        'image',
        'order',
        'status',
    ];

    protected $casts = [
        'highlights' => 'array',
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($history_timeline) {
            if (empty($history_timeline->uuid)) {
                $history_timeline->uuid = Str::uuid();
            }
        });
    }

    // Scope: Active only
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope: Ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('decade', 'asc');
    }

    // Helper: Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-history.jpg');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'uuid'; // Optional: Use UUID for route model binding
    }
}
