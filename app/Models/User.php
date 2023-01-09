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

    public function solicituds() {
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

    public function isAdmin() {
        return $this->admin;
    }

    public function isSupervisor() {
        return $this->supervisor;
    }

    public function isSupervisado() {
        return $this->supervisado;
    }

    public function createUser($request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->admin = $request->admin;
        $user->supervisor = $request->supervisor;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->formacion = $request->formacion;
        $user->image_url = $request->image_url;
        $user->supervisado = $request->supervisado;
        $user->category_id = $request->category_id;
        $user->save();
        return $user;
    }

    public function updateUser($request, $id) {
        $user = User::find($id);
        if($request->name != null) {
            $user->name = $request->name;
        }
        if($request->email != null) {
            $user->email = $request->email;
        }
        if($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        if($request->admin != null) {
            $user->admin = $request->admin;
        }
        if($request->supervisor != null) {
            $user->supervisor = $request->supervisor;
        }
        if($request->fecha_nacimiento != null) {
            $user->fecha_nacimiento = $request->fecha_nacimiento;
        }
        if($request->formacion != null) {
            $user->formacion = $request->formacion;
        }
        if($request->image_url != null) {
            $user->image_url = $request->image_url;
        }
        if($request->supervisado != null) {
            $user->supervisado = $request->supervisado;
        }
        if($request->category_id != null) {
            $user->category_id = $request->category_id;
        }
        $user->save();
        return $user;
    }

    public function getAllUsers() {
        return User::all();
    }

    // get user by id
    public function getUser($id) {
        return User::find($id);
    }
    
    public function createJornada($request) {
        $jornada = new Jornada();
        $jornada->fecha = $request->fecha;
        $jornada->horas = $request->horas;
        $jornada->user_id = $request->user_id;
        $jornada->save();
        return $jornada;
    }
}
