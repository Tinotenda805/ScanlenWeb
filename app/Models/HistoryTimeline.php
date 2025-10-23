<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryTimeline extends Model
{

    use HasFactory, SoftDeletes;

    // protected $table = 'history_timelines';

    protected $fillable = [
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
}
