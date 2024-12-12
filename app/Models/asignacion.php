<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'hora_salida',
        'fecha_estimada_dev',
        'no_licencia',
        'estatus',
        'condiciones',
        'autorizante'
    ];

    // Asegura que la fecha de asignación y la fecha estimada de devolución se asignen automáticamente
    protected $dates = [
        'fecha_asignacion',

    ];

    // Método para obtener la fecha de asignación automáticamente
    public static function boot()
    {
        parent::boot();

        static::creating(function ($asignacion) {
            // Asignar la fecha de asignación automáticamente si está vacía
            if (empty($asignacion->fecha_asignacion)) {
                $asignacion->fecha_asignacion = date('Y-m-d');
            }

        });
    }

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
    return $this->hasMany(CheckIn::class, 'id_asignacion', 'id_asignacion');
}
}
