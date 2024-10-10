<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; // Add this line

class User extends Model // Extend the correct Model class
{
    use HasFactory, Notifiable;

    protected $fillable = ['username', 'email', 'password', 'phone_number', 'address', 'role'];

    // Untuk hash password saat pembuatan user baru
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
