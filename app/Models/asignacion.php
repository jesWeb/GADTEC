<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class asignacion extends Model
{

    use HasFactory;
    use SoftDeletes;

     protected $table = 'asignacions';
     protected $primarykey = 'id_asignacion';

    protected $fillable = [
        'id_usuario',
        'telefono',
        'requierechofer',
        'nombre_chofer',
        'id_automovil',
        'fecha_salida',
        'lugar',
        'hora_salida',
        'no_licencia',
        'condiciones',
        'observaciones',
        'autorizante',
    ];

    public function automovil() {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }

    public function asicnacion(){
        return $this->belongsTo(asignacion::class,'id_asignacion');
    }


}
