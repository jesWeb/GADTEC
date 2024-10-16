<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seguros extends Model
{
    use HasFactory;
      protected $fillable = [
        'vehiculo',
        'aseguradora',
        'cobertura',
        'fecha_vigencia',
        'monto',
        'poliza',
        'estatus',
    ];
}
