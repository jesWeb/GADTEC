<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Automoviles extends Model
{
    use HasFactory, SoftDeletes;

	protected $primaryKey = 'id_automovil';
	protected $fillable = [
        'marca',
        'submarca',
        'modelo',
        'num_serie',
        'num_motor',
        'capacidad_combustible',
        'tipo_combustible',
        'tipo_automovil',
        'kilometraje',
        'placas',
        'num_nsi',
        'uso',
        'color',
        'num_puertas',
        'estatus',
        'fecha_registro',
        'responsable',
        'observaciones',
        'fotografias',
        // 'activo',
    ];

    public function tarjetas() {
        return $this->hasMany(TarjetaCirculacion::class, 'id_automovil');
    }
    public function tenencias() {
        return $this->hasMany(TeneciasRefrendos::class, 'id_automovil');
    }
    public function multas() {
        return $this->hasMany(Multas::class, 'id_automovil');
    }
    public function servicios() {
        return $this->hasMany(Servicios::class, 'id_automovil');
    }

}
