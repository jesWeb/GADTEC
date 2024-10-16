<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class asignacion extends Model
{

    use HasFactory;
    use SoftDeletes;

     protected $primarykey = 'id';

    protected $fillable = [
        'solicitante',
        'telefono',
        'requierechofer',
        'nombre_chofer',
        'vehiculo',
        'lugar',
        'hora_salida',
        'no_licencia',
        'condiciones',
        'observaciones',
        'autorizante',
    ];
}
