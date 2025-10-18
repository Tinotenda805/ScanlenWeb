<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudgementDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'judgement_id',
        'ip_address',
        'user_agent',
        'downloaded_at',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    public $timestamps = false;

    // Relationship: Judgement
    public function judgement()
    {
        return $this->belongsTo(Judgement::class);
    }
}
