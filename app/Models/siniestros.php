<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class siniestros extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sinister';

    protected $fillable = [
        'fecha_siniestro',
        'descripcion',
        'estatus',
        'costo_danos_estimados',
        'costo_real_danos',
        'responsable',
        'observaciones',
    ];

    protected $dates = [
        'fecha_siniestro',
    ];

    // Definición de constantes para estatus
    const ESTATUS_ACTIVO = 'activo';
    const ESTATUS_VENCIDO = 'vencido';

}
