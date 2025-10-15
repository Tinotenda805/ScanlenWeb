<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Expertise extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'expertise';

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'overview',
        'image',
        'banner_image',
        'is_featured',
        'order',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    // Auto-generate slug from name
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expertise) {
            if (empty($expertise->slug)) {
                $expertise->slug = Str::slug($expertise->name);
            }
        });

        static::updating(function ($expertise) {
            if ($expertise->isDirty('name') && empty($expertise->slug)) {
                $expertise->slug = Str::slug($expertise->name);
            }
        });
    }

    // Relationship: Related Expertise
    public function relatedExpertise()
    {
        return $this->belongsToMany(
            Expertise::class,
            'expertise_relations',
            'expertise_id',
            'related_expertise_id'
        )->withTimestamps();
    }

    // Relationship: People (Key Contacts)
    public function people()
    {
        return $this->belongsToMany(
            OurPeople::class,
            'expertise_people',
            'expertise_id',
            'person_id'
        )
        ->withPivot('order')
        ->withTimestamps()
        ->orderBy('expertise_people.order', 'asc');
    }

    // Scope: Active expertise only
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope: Featured expertise
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('status', 'active');
    }

    // Scope: Ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('name', 'asc');
    }

    // Get route key for URLs
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Helper: Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-expertise.jpg');
    }

    // Helper: Get banner URL
    public function getBannerUrlAttribute()
    {
        if ($this->banner_image) {
            return asset('storage/' . $this->banner_image);
        }
        return asset('images/default-banner.jpg');
    }
}