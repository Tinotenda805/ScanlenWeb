<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'author_name',
        'reading_time',
        'views',
        'is_featured',
        'is_published',
        'published_at',
        'comments_enabled',
        'focus_keyword',
        'meta_description',
        'seo_score',
        'readability_score',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'comments_enabled' => 'boolean',
        'views' => 'integer',
        'seo_score' => 'integer',
        'readability_score' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            if (empty($blog->published_at)) {
                $blog->published_at = now();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tags');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(BlogComment::class)->where('is_approved', true)->latest();
    }


    public function incrementViews()
    {
        $this->increment('views');
    }

    // SEO Status Helper
    public function getSeoStatus()
    {
        if ($this->seo_score >= 80) return 'good';
        if ($this->seo_score >= 50) return 'ok';
        return 'bad';
    }

    public function getSeoStatusColor()
    {
        $status = $this->getSeoStatus();
        return match($status) {
            'good' => 'success',
            'ok' => 'warning',
            'bad' => 'danger',
            default => 'secondary'
        };
    }

    // Readability Status Helper
    public function getReadabilityStatus()
    {
        if ($this->readability_score >= 70) return 'good';
        if ($this->readability_score >= 50) return 'ok';
        return 'bad';
    }

    public function getReadabilityStatusColor()
    {
        $status = $this->getReadabilityStatus();
        return match($status) {
            'good' => 'success',
            'ok' => 'warning',
            'bad' => 'danger',
            default => 'secondary'
        };
    }



    // SCOPES
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    
}
