<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
    protected $table = 'Alojamiento';
    protected $primaryKey = 'id_alojamiento'; 

    protected $fillable = [
        'nombre_aloj',
        'nro_estrellas',
        'nro_habitaciones',
        'Activo'
    ];

    public $timestamps = true;
}



