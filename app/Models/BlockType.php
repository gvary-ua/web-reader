<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockType extends Model
{
    use HasFactory;
    protected $table = 'block_types';

    protected $primaryKey = 'block_type_id';

    protected $fillable = ['label'];
}
