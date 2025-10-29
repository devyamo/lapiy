<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phc_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function phc()
    {
        return $this->belongsTo(Phc::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPhcStaff()
    {
        return $this->role === 'phc_staff';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}