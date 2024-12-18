<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Multas extends Model
{
    use HasFactory,SoftDeletes;

    // protected $table = 'multas';
	protected $primaryKey = 'id_multa';
	protected $fillable = [
        'tipo_multa',
        'monto',
        'fecha_multa',
        'lugar',
        'estatus',
        'comprobante',
        'observaciones',
        'activo',
        'id_automovil'
    ];

    public function automovil(){
        return $this->belongsTo(Automoviles::class,'id_automovil');
    }

}
