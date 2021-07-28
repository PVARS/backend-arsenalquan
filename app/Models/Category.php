<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    protected $fillable = [
        'category_name',
        'slug',
        'icon',
        'disabled'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at'
    ];
}
