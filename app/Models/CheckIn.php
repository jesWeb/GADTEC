<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckIn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'check_ins';
    protected $primaryKey = 'id_check';

    protected $fillable = [
        'id_asignacion',
        'km_salida',
        'combustible_salida',
        'hora_salida',
        'km_llegada',
        'combustible_llegada',
        'hora_llegada',
        'fecha_llegada', 
    ];

    protected $casts = [
        'fecha_llegada' => 'datetime', 
    ];

    public function asignacion()
    {
        return $this->belongsTo(asignacion::class, 'id_asignacion');
    }
}
