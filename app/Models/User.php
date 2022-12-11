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

    public function directions() {
        return $this->hasMany(Direction::class);
    }

    public function supervisado() {
        return $this->hasOne(User::class);
    }

    public function category() {
        return $this->hasOne(Category::class);
    }

    public function nominas() {
        return $this->hasMany(Nomina::class);
    }

    public function solicitudes() {
        return $this->hasMany(Solicitud::class);
    }

    public function jornadas() {
        return $this->hasMany(Jornada::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
