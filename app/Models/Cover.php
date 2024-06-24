<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cover extends Model
{
    use HasFactory;

    protected $table = 'covers';

    protected $primaryKey = 'cover_id';

    protected $fillable = [
        'cover_type_id',
        'cover_status_id',
        'lang_id',
        'chapter_ids',
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
        'chapter_ids' => 'array', // 'chapter_ids' is a JSON array
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

    /** @var Chapter */
    public function appendChapter($chapter)
    {
        $this->chapter_ids = array_merge($this->chapter_ids, [$chapter->chapter_id]);

        return $this;
    }

    /** @var Chapter */
    public function removeChapter($chapter)
    {
        $temp = $this->chapter_ids;
        $index = array_search($chapter->chapter_id, $temp);
        unset($temp[$index]);

        $this->chapter_ids = array_values($temp);

        return $this;
    }

    public function chapters()
    {
        return Chapter::all()->filter(function ($chapter) {
            return in_array($chapter->chapter_id, $this->chapter_ids) ? $chapter : null;
        });
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'authors', 'cover_id', 'user_id');
    }
}
