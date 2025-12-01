<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Statistic extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'label',
        'value',
        'icon',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($statistic) {
            if (empty($statistic->uuid)) {
                $statistic->uuid = Str::uuid();
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
        return $query->orderBy('order', 'asc');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'uuid'; // Optional: Use UUID for route model binding
    }
}
