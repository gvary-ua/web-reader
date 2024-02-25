<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverType extends Model
{
    use HasFactory;
    protected $table = 'cover_types';

    protected $primaryKey = 'cover_type_id';

    protected $fillable = ['label'];
}
