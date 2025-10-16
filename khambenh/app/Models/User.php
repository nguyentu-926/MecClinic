<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // patient | doctor | staff | admin
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Quan hệ 1-1 với Patient
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    // Quan hệ 1-1 với Doctor
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    // Quan hệ 1-1 với Staff
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }
}
