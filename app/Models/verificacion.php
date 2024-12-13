<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verificacion extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'verificacions';
    protected $primaryKey = 'id_verificacion';

    protected $fillable = [
        'id_automovil',
        'engomado',
        'holograma',
        'fecha_verificacion',
        'proxima_verificacion',
        'estadoV',
        'observaciones',
        'image',
        'motivo_00',
        'fecha_verificacion_00',
        'proxima_verificacion_00'
    ];


    protected $cats = [
        'image' => 'array',
    ];




    public function automovil()
    {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }
}
