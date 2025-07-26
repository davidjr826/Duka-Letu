<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_CASHIER = 'cashier';
    public const ROLE_USER = 'user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'photo',
        'about_me',
        'gender'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth_date' => 'date',
        'joining_date' => 'date',
        'is_active' => 'boolean'
    ];

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    // Role check methods
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isCashier(): bool
    {
        return $this->role === self::ROLE_CASHIER;
    }

    // Role assignment methods
    public function makeAdmin(): void
    {
        $this->update(['role' => self::ROLE_ADMIN]);
    }

    public function makeCashier(): void
    {
        $this->update(['role' => self::ROLE_CASHIER]);
    }

    public function makeRegularUser(): void
    {
        $this->update(['role' => self::ROLE_USER]);
    }

    // Profile photo URL accessor
    public function getPhotoUrlAttribute()
    {
        return $this->photo 
            ? asset('storage/'.$this->photo)
            : asset('/images/login.jpg');
    }
}