<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageCode extends Model
{
    use HasFactory;

    protected $table = 'language_codes';
    protected $primaryKey = 'lang_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['label'];
}
