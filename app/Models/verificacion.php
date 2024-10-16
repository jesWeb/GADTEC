<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verificacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primarykey = 'id';

    protected $fillable = [
        'vehiculo',
        'holograma',
        'engomado',
        'fechaV',
        'fechaP',
        'observaciones',
       'image'
    ];
}
