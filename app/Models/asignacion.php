<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class asignacion extends Model
{
    use HasFactory ,SoftDeletes;
     protected $primarykey = 'id_asignacion';
    protected $fillable = [
        'id_automovil',
        'id_usuario',
        'telefono',
        'requierechofer',
        'nombre_chofer',
        'lugar',
        'fecha_salida',
        'hora_salida',
        'no_licencia',
        'estatus',
        'condiciones',
        'observaciones',
        'autorizante',
    ];

    public function automovil() {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }

    public function usuarios(){
        return $this->belongsTo(usuarios::class,'id_usuario');
    }


}
