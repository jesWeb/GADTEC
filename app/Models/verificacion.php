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
        'observaciones',
        'image',
    ];


    protected $cats = [
        'image' => 'array',
    ];


    // //metodo para la verificacion
    // public function ObtenerVerificacion()
    // {
    //     //obtener el color del vehiculo
    //     $color  = strtolower($this->engomado);
    //     //obtener el ano actual
    //     $ano_actual = Carbon::now()->year();

    //     //validacion de las proximas verificaciones de acuerdo al engomado

    //     switch ($color) {
    //         //octubre Noviembre
    //         case 'verde':
    //             return
    //                 Carbon::create($ano_actual, 7, 1);
    //         //Agosto septiembre
    //         case 'rojo':
    //             return
    //                 Carbon::create($ano_actual, 6, 1);
    //         //noviembre diciembre
    //         case 'azul':
    //             return
    //                 Carbon::create($ano_actual, 5, 1);
    //         default:
    //             return
    //                 Carbon::create($ano_actual, 9, 0);

    //     }
    // }



    public function automovil()
    {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }
}
