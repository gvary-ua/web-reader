<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverGenre extends Model
{
    use HasFactory;

    protected $table = 'cover_genres';

    protected $fillable = [
        'cover_id',
        'genre_id',
        'label'
    ];

    public function cover()
    {
        return $this->belongsTo(Cover::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
