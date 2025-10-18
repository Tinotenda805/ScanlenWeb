<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'icon',
        'order',
        'status',
    ];

    protected $casts = [
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
        return $query->orderBy('order', 'asc');
    }
}
