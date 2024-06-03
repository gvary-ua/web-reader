<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $table = 'covers';

    protected $primaryKey = 'cover_id';

    protected $fillable = [
        'cover_type_id',
        'cover_status_id',
        'lang_id',
        'title',
        'description',
        'img_key',
        'public',
        'average_reading_time_sec',
        'words_count',
        'published_at',
        'finished_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}
