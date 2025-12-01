<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'gallery';


    protected $fillable = [
        'uuid',
        'title',
        'description',
        'image',
        'category',
        'badge_label',
        'link_url',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            if (empty($gallery->uuid)) {
                $gallery->uuid = Str::uuid();
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Helper: Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-gallery.jpg');
    }

    // Helper: Get filter class
    public function getFilterClassAttribute()
    {
        return 'filter-' . $this->category;
    }


    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'uuid'; // Optional: Use UUID for route model binding
    }
}
