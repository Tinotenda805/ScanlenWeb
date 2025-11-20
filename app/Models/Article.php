<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'reading_time',
        'views',
        'is_featured',
        'is_published',
        'published_at',
        'focus_keyword',
        'meta_description',
        'seo_score',
        'readability_score',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
        'reading_time' => 'integer',
        'seo_score' => 'integer',
        'readability_score' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            if (empty($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    public function authors()
    {
        return $this->belongsToMany(OurPeople::class, 'article_authors', 'article_id', 'author_id')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
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

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getReadingTimeAttribute($value)
    {
        return $value . ' min read';
    }

    public function getReadingTimeRawAttribute()
    {
        return $this->attributes['reading_time']; // Raw value from database
    }


}
