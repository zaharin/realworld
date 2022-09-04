<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'description',
        'body',
    ];

    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Tag::class, 'commentable');
    }
}
