<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'slug', 'category', 'author', 'date', 'image', 'excerpt', 'content', 'moral', 'views', 'reading_time'];
    protected $casts = [
        'content' => 'array',
        'date' => 'date',
    ];
}
