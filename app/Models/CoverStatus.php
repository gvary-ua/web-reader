<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverStatus extends Model
{
    use HasFactory;
    protected $table = 'cover_statuses';

    protected $primaryKey = 'cover_status_id';

    protected $fillable = ['label'];
}
