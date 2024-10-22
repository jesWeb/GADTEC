<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
	protected $primaryKey = 'id_usuario';
	protected $fillable = [
            'num_empleado', 
            'nombre',
            'app',
            'apm',
            'empresa',
            'fn',
            'sex',
            'rol',
            'gen',
            'foto',
            'email',
            'usuario',
            'pass',
            'estatus',
            'activo',
            'id_rol'
        ];


}
