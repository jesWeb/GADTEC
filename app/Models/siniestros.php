<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class siniestros extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sinister';
    protected $primaryKey = 'id_siniestro';
    protected $fillable = [
        'id_automovil',
        'fecha_siniestro',
        'descripcion',
        'estatus',
        'costo_danos_estimados',
        'costo_real_danos',
        'id_usuario',
        'observaciones',
    ];

    public function automovil() {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }
    public function usuarios() {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }



}
