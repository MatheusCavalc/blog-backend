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
        'image',
        'title_preview',
        'content_preview',
        'title',
        'content',
        'user_id',
        'editor_name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
