<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarjetaCirculacion extends Model
{
    use HasFactory;

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

    public function automovil() {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }
    
}
