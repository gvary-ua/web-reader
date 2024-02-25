<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $primaryKey = 'block_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'block_nanoid_10',
        'chapter_id',
        'block_type_id',
        'data',
        'word_count'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}
