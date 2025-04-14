<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'image',
        'description',
        'content',
        'published_at',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
