<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verificacion extends Model
{
    use HasFactory,SoftDeletes;


    protected $table = 'verificacions';
    protected $primaryKey = 'id_verificacion';

    protected $fillable = [
        'id_automovil',
        'holograma',
        'engomado',
        'fechaV',
        'fechaP',
        'observaciones',
        'image'
    ];
    public function automovil() {
        return $this->belongsTo(Automoviles::class, 'id_automovil');
    }
}
