<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'domain'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::created(function ($user) {

            $tenant = \App\Models\Tenant::create([
                'id' => $user->domain
            ]);

            $tenant->domains()->create([
                'domain' => $user->domain . '.localhost'
            ]);

        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}