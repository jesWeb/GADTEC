<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class asignacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'asignacions';
    protected $primaryKey = 'id_asignacion';

    protected $fillable = [
        'id_automovil',
        'id_usuario',
        'telefono',
        'requierechofer',
        'nombre_chofer',
        'lugar',
        'motivo',
        'fecha_salida',
        'fecha_estimada_dev',
        'hora_salida',
        'hora_llegada',
        'no_licencia',
        'estatus',
        'condiciones',
        'observaciones',
        'autorizante',
    ];





    public function automovil()
    {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }


    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario');
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class, 'id_asignacion');
    }

}
