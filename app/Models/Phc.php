<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Phc extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'clinic_name',
        'lga',
        'ward',
        'username',
        'password',
        'is_active'
    ];

    protected $hidden = [
        'password'
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function generateUniqueId($lga, $ward, $serialNumber)
    {
        $lgaCode = strtoupper(substr($lga, 0, 3));
        $wardCode = strtoupper(substr($ward, 0, 3));
        
        return $lgaCode . '/' . $wardCode . '/' . $serialNumber;
    }
}