<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issuing_organization',
        'year',
        'description',
        'image',
        'display_order',
        'is_active',
        'category'
    ];

    protected $casts = [
        'year' => 'integer',
        'display_order' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Scope for active awards
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering by display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('year', 'desc');
    }

    /**
     * Scope for recent awards (last 5 years)
     */
    public function scopeRecent($query, $years = 5)
    {
        $currentYear = date('Y');
        return $query->where('year', '>=', $currentYear - $years);
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * Get category options
     */
    public static function getCategories()
    {
        return [
            'legal' => 'Legal Excellence',
            'corporate' => 'Corporate Law',
            'client_service' => 'Client Service',
            'innovation' => 'Innovation',
            'community' => 'Community Service',
            'leadership' => 'Leadership'
        ];
    }
}
