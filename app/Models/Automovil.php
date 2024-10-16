<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Automovil extends Model
{
    use HasFactory, SoftDeletes ;

     protected $primarykey = 'id';

    protected $fillable = [
        'marca',
        'submarca',
        'modelo',
        'serie',
        'motor',
        'combustible',
        'kilometraje',
        'placas',
        'NSI',
        'uso',
        'responsable',
        'observaciones',
        'image',
    ];




}
