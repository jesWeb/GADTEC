<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable as LaravelAuthenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

class Usuarios extends Model implements Authenticatable, CanResetPasswordContract
{
    use HasFactory, Notifiable, SoftDeletes, LaravelAuthenticatable, CanResetPassword;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'num_empleado', 'nombre', 'app', 'apm', 'empresa', 'fn', 'sex', 'rol', 'gen',
        'foto', 'email', 'usuario', 'pass', 'estatus', 'activo',
    ];

    protected $hidden = [
        'pass',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['pass'] = bcrypt($value);
    }
    public function findForPasswordReset($email)
    {
        return $this->where('email', $email)->first();
    }


    public function asignacion()
    {
        return $this->hasOne(asignacion::class, 'id_asignacion');
    }

    public function siniestros()
    {
        return $this->hasOne(siniestros::class, 'id_siniestro');
    }

    // Método para verificar si el usuario tiene un rol específico
    public function hasRole($role)
    {
        return $this->rol === $role;
    }
}