<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'category_id',
        'title',
        'short_description',
        'thumbnail',
        'content',
        'key_word',
        'view',
        'slug',
        'approve',
        'approved_by',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

    protected $hidden = [];
}
