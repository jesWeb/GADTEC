<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automoviles extends Model
{
    use HasFactory;
    protected $table = 'automoviles';
	protected $primaryKey = 'id_automovil';
	protected $fillable = [
        'num_serie',
        'marca', 
        'submarca',
        'modelo', 
        'num_motor', 
        'tipo_combustible',
        'kilometraje',
        'placas',
        'num_nsi',
        'uso',
        'estatus',
        'fecha_registro',
        'responsable',
        'fotografias',
        'observaciones',
        'activo',
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
