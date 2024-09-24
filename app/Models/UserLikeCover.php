<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLikeCover extends Model
{
    use HasFactory;

    protected $table = 'user_liked_cover';

    protected $primaryKey = 'like_id';

    protected $fillable = ['user_id', 'cover_id'];

    protected $casts = [
        'published_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cover(): BelongsTo
    {
        return $this->belongsTo(Cover::class, 'cover_id');
    }
}
