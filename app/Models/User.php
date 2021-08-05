<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'user';

    function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    protected $fillable = [
        'login_id',
        'role_id',
        'email',
        'full_name',
        'disabled',
        'password',
        'reset_link_token',
        'token',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    protected $hidden = [];
}
