<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'tags',
        'title',
        'content',
        'editor_id',
        'editor_name'
    ];
}
