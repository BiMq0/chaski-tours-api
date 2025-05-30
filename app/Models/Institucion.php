<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'Instituciones';
protected $fillable = [ 
    'nombre', 
    'correo_electronico', 
    'contrasenia', 
    'nacionalidad', 
    'prefijo_telefonico', 
    'telefono', 
    'nombre_represent', 
    'ap_pat_represent', 
    'correo_electronico_represent', 
    'telefono_represent'
];
}
