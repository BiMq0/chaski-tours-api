<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'Ubicacion';
    protected $primaryKey = 'id_ubicacion';
protected $fillable = [
    'id_ubicacion',
    'departamento', 
    'municipio', 
    'zona', 
    'calle', 
    'latitud', 
    'longitud'
];
}
