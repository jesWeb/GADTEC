<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;

    protected $table = 'servicios';
	protected $primaryKey = 'id_servicio';
	protected $fillable = [
        'tipo_servicio',
        'descripcion', 
        'fecha_servicio',
        'prox_servicio', 
        'costo', 
        'lugar_servicio',
        'activo',
        'comprobante',
        'id_automovil'
    ];

    public function automovil(){ 
        return $this->belongsTo(Automoviles::class,'id_automovil'); 
    }

  
}
