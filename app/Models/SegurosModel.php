<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegurosModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'automovil',
        'aseguradora',
        'fechaSiniestro',
        'estatus',
        'responsable',
        'CostoEstimado',
        'CostoFinal',
        'descripcion',
        'observaciones'
    ];

}
