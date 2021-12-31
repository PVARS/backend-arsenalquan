<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';

    function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'id',
        'role_name',
        'disabled',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

    protected $hidden = [];
}
