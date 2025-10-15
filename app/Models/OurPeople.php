<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurPeople extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'bio',
        'avatar',
        'twitter',
        'linkedin',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($person) {
            if (empty($person->slug)) {
                $person->slug = Str::slug($person->name);
            }
        });
    }

    /**
     * Many-to-Many: One person can write multiple articles
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_authors', 'author_id', 'article_id')
            ->withTimestamps();
    }

    public function expertise()
    {
        return $this->belongsToMany(
            Expertise::class,
            'expertise_people',
            'person_id',
            'expertise_id'
        )
        ->withPivot('order')
        ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope for partners only
     */
    public function scopePartners($query)
    {
        return $query->where('type', 'partner');
    }

    /**
     * Scope for associates only
     */
    public function scopeAssociates($query)
    {
        return $query->where('type', 'associate');
    }
}
