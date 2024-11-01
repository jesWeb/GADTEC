<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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

    //reacion uno a muchos
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

    public function verificacion(){
        return  $this-> hasMany(verificacion::class,'id_automovil');
    }

    public function asignacion(){
        return $this->hasMany(asignacion::class,'id_automovil');
    }

    public function siniestro(){
        return $this->hasMany(siniestros::class,'id_automovil');
    }
    //relacion uno a uno
    public function seguro(){
        return $this->hasOne(seguros::class,'id_automovil');
    }

}
