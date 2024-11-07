<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckIn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'check_ins';

    protected $fillable = [
        'id_asignacion',
        'km_salida',
        'combustible_salida',
        'hora_salida',
        'km_llegada',
        'combustible_llegada',
        'hora_llegada',
        'fecha_llegada', // Se agregará automáticamente
    ];

    protected $casts = [
        'fecha_llegada' => 'datetime', // Esto convierte `fecha_llegada` a un objeto DateTime automáticamente
    ];

    // Asignar fecha de llegada automática cuando se cree un CheckIn
    protected static function booted()
    {
        static::creating(function ($checkIn) {
            // Asignar fecha de llegada automáticamente (cuando se crea un CheckIn)
            $checkIn->fecha_llegada = now(); // Fecha actual 
        });
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'id_asignacion');
    }
}
