<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurPeople extends Model
{
    use HasFactory;

    protected $table = 'our_people';

    protected $fillable = [
        'name',
        'designation',
        'email',
        'phone',
        'bio',
        'profile_overview',
        'avatar',
        'banner_image',
        'years_of_experience',
        'deals_completed',
        'languages',
        'linkedin_url',
        'whatsapp_number',
        'location',
        'areas_of_expertise',
        'professional_experience',
        'qualifications',
        'specializations',
        'type', // 'partner' or 'associate'
        'role',
        // 'category_id',
        'order',
        'status',
    ];

    protected $casts = [
        'areas_of_expertise' => 'array',
        'professional_experience' => 'array',
        'qualifications' => 'array',
        'years_of_experience' => 'integer',
        'deals_completed' => 'integer',
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($person) {
            if (empty($person->slug)) {
                $person->slug = Str::slug($person->name);
            }
        });

        static::updating(function ($person) {
            if (empty($person->slug)) {
                $person->slug = Str::slug($person->name);
            }
        });
    }

    // Relationship: Category (Sector)
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_people', // pivot table name
            'person_id',
            'category_id'
        )
        ->withTimestamps();
    }

    // Relationship: Expertise
    // public function expertise()
    // {
    //     return $this->belongsToMany(
    //         Expertise::class,
    //         'our_people_expertises',
    //         'person_id',
    //         'expertise_id'
    //     )
    //     ->withTimestamps()
    //     ->orderBy('expertise.order', 'asc');
    // }
    public function expertise()
    {
        return $this->belongsToMany(
            Expertise::class,
            'expertise_people',
            'person_id',
            'expertise_id'
        )
        ->withTimestamps()
        ->orderBy('expertise_people.order', 'asc');
    }

    // Relationship: Articles
    // public function articles()
    // {
    //     return $this->hasMany(Article::class, 'author_id');
    // }
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_authors', 'author_id', 'article_id');
    }


    // Relationship: Blogs
    // public function blogs()
    // {
    //     return $this->hasMany(Blog::class, 'author_id');
    // }

    // Scopes
    public function scopePartners($query)
    {
        return $query->where('type', 'partner');
    }

    public function scopeAssociates($query)
    {
        return $query->where('type', 'associate');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // public function scopeOrdered($query)
    // {
    //     return $query->orderBy('order', 'asc')->orderBy('name', 'asc');
    // }

    // Helper: Get avatar URL
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return asset('images/person.svg');
    }

    // Helper: Get banner URL
    public function getBannerUrlAttribute()
    {
        if ($this->banner_image) {
            return asset('storage/' . $this->banner_image);
        }
        return asset('images/person.svg');
    }

    // Helper: Get WhatsApp link
    public function getWhatsappLinkAttribute()
    {
        if ($this->whatsapp) {
            // Remove all non-numeric characters
            $number = preg_replace('/[^0-9]/', '', $this->whatsapp);
            return "https://wa.me/{$number}";
        }
        return null;
    }

    // Helper: Get recent insights (articles + blogs)
    public function getRecentInsightsAttribute()
    {
        $articles = $this->articles()->where('is_published', '1')->latest()->take(3)->get();
        // $blogs = $this->blogs()->where('is_published', '1')->latest()->take(3)->get();
        
        // return $articles->merge($blogs)->sortByDesc('created_at')->take(5);
        return $articles->sortByDesc('created_at')->take(5);
    }
}
