<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservacionModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'automovil',
        'responsable',
        'fechaR',
        'salida',
        'destino',
        'Motivo',
        'fechaI',
        'placas',
        'NSI',
        'uso',
        'responsable',
        // 'observaciones',
        // 'image',
    ];

}
