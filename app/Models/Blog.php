<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
