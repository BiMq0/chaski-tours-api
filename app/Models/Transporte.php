<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    protected $table = 'Transporte';
    protected $primaryKey = 'id_vehiculo';
    protected $fillable = [
    'matricula', 
    'marca', 
    'modelo', 
    'capacidad', 
    'año', 
    'disponible', 
    'Activo'
];
}
