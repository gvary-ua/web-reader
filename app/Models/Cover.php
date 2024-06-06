<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function coverType(): BelongsTo
    {
        return $this->belongsTo(CoverType::class, 'cover_type_id', 'cover_type_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'cover_genres', 'cover_id', 'genre_id');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'cover_id', 'cover_id');
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'authors', 'cover_id', 'user_id');
    }
}
