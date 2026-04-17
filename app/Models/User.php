<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }

    // Untuk Filament: menentukan apakah user bisa akses panel
    public function canAccessPanel(Panel $panel): bool
    {
        return true; 
    }

    // Untuk Filament: mengambil nama user
    public function getFilamentName(): string
    {
        return $this->nama ?? $this->username ?? 'User';
    }
}