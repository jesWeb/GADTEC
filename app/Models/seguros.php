<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class seguros extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'seguros';
    protected $primaryKey = 'id_seguro';

    protected $fillable = [
        'id_automovil',
        'aseguradora',
        'cobertura',
        'fecha_vigencia',
        'monto',
        'poliza',
        'estatus',
    ];

    //conertir a fotografias a json
    protected $cats = [
        'poliza' => 'array',
    ];


    public function automovil()
    {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }
}
