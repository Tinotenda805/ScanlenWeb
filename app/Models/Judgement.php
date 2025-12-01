<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Judgement extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'uuid',
        'title',
        'case_number',
        'description',
        'judgement_date',
        'court',
        'file_path',
        'file_type',
        'file_size',
        'download_count',
        'category_id',
        'tags',
        'is_featured',
        'order',
        'status',
    ];

    protected $casts = [
        'judgement_date' => 'date',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'order' => 'integer',
        'download_count' => 'integer',
        'file_size' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($judgement) {
            if (empty($judgement->uuid)) {
                $judgement->uuid = Str::uuid();
            }
        });
    }

    // Relationship: Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: Downloads
    public function downloads()
    {
        return $this->hasMany(JudgementDownload::class);
    }

    // Scope: Active only
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope: Featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('status', 'active');
    }

    // Scope: Ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('judgement_date', 'desc');
    }

    // Scope: By Court
    public function scopeByCourt($query, $court)
    {
        return $query->where('court', $court);
    }

    // Helper: Get file URL
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    // Helper: Get formatted file size
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return 'N/A';

        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = $this->file_size;
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Increment download count
    public function incrementDownloadCount()
    {
        $this->increment('download_count');
        
        // Track the download
        $this->downloads()->create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'downloaded_at' => now(),
        ]);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'uuid'; // Optional: Use UUID for route model binding
    }
}
