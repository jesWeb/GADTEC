<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeneciasRefrendos extends Model
{
    use HasFactory;

    protected $table = 'tenencias';
	protected $primaryKey = 'id_tenencia';
	protected $fillable = [
        'fecha_pago',
        'origen', 
        'monto',
        'año_correspondiente', 
        'estatus', 
        'comprobante',
        'observaciones',
        'activo',
        'id_automovil'
    ];

    public function automovil() {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }

}
