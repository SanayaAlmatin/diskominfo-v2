<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'nama',
        'email',
        'no_telp',
        'alamat',
        'instansi',
        'photo',
        'avatar',
        'role',
        'password',
        'google_id',
        'remember_token',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'google2fa_enabled' => 'boolean',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_has_roles', 'user_id', 'role_id');
    }

    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }

    public function isAdmin(): bool
    {
        return $this->hasAnyRole(['super-admin', 'admin']);
    }

    public function getCmsRole(): string
    {
        if ($this->hasRole('super-admin')) {
            return 'super-admin';
        }
        if ($this->hasRole('admin')) {
            return 'admin';
        }
        if ($this->hasRole('guest')) {
            return 'guest';
        }

        // Fallback to legacy role column
        return match ($this->role) {
            'super-admin' => 'super-admin',
            'verifikator', 'editor' => 'admin',
            default => 'guest',
        };
    }
}
