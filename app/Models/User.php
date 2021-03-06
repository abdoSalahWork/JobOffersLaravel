<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $visible = [
        'id',
        'firstName',
        'lastName',
        'email',
        'phone',
        'access_token'
    ];

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'password',
        'roleId',
        'access_token',
        'userStatus'
    ];

    public function job()
    {
        return $this->hasMany(Job::class, 'userId', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId', 'id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
