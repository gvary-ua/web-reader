<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory;

    protected $primaryKey = 'chapter_id';

    protected $fillable = [
        'cover_id',
        'title',
        'block_ids'
    ];

    protected $casts = [
        'public' => 'boolean',
        'word_count' => 'integer',
        'published_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];
}
