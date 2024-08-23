<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

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

    protected $attributes = [
        'public' => false,
        'chapter_ids' => '[]',
    ];

    public function coverType(): BelongsTo
    {
        return $this->belongsTo(CoverType::class, 'cover_type_id', 'cover_type_id');
    }

    public function coverStatus(): BelongsTo
    {
        return $this->belongsTo(CoverStatus::class, 'cover_status_id', 'cover_status_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(LanguageCode::class, 'lang_id', 'lang_id');
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
        $selectChaptersInOrder = '
            select c.* from chapters as c
            join json_array_elements(?::json) with ordinality as o (id, ord)
            on c.chapter_id = o.id::text::int
            order by o.ord asc;
        ';

        return DB::select($selectChaptersInOrder, [json_encode($this->chapter_ids, JSON_UNESCAPED_SLASHES)]);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'authors', 'cover_id', 'user_id');
    }
}
