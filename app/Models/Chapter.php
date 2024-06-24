<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory;

    protected $primaryKey = 'chapter_id';

    protected $fillable = [
        'cover_id',
        'title',
        'block_ids',
    ];

    protected $casts = [
        'block_ids' => 'array', // 'block_ids' is a JSON array
        'public' => 'boolean',
        'word_count' => 'integer',
        'published_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    protected $attributes = [
        'public' => false,
        'block_ids' => '[]',
    ];

    public function cover(): BelongsTo
    {
        return $this->belongsTo(Cover::class, 'cover_id');
    }
}
