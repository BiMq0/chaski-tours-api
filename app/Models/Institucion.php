<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'Instituciones';
protected $fillable = [
    'cod_visitante', 
    'nombre', 
    'correo_electronico', 
    'contrasenia', 
    'telefono', 
    'nombre_represent', 
    'ap_pat_represent', 
    'correo_electronico_represent', 
    'nacionalidad', 
    'prefijo_telefonico', 
    'telefono_represent'
];
}
