<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TarjetaCirculacion extends Model
{
    
    use HasFactory, SoftDeletes;

    protected $table = 'tarjetas';
    protected $primaryKey = 'id_tarjeta';
    protected $fillable = [
        'nombre',
        'num_tarjeta',
        'vehiculo_origen',
        'fecha_expedicion',
        'fecha_vigencia',
        'estatus',
        'id_automovil',
        'fotografia_frontal',
        'activo'
    ];

    //convertir imagen a json
    // protected $cats = [
    //     'fotografia_frontal' => 'array',
    // ];

    public function automovil() {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }

}
