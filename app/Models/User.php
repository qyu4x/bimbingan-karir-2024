<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helper\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'id_user', 'id');
    }

    public function pasien(): HasOne
    {
        return $this->hasOne(Pasien::class, 'id_user', 'id');
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN;
    }

    public function isDoctor(): bool
    {
        return $this->role === Role::DOCTOR;
    }

    public function isPatient(): bool
    {
        return $this->role === Role::PATIENT;
    }

}
