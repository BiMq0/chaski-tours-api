<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Transporte extends Model
{
    protected $table = 'Transporte';
    protected $primaryKey = 'id_vehiculo';
    protected $fillable = [
<<<<<<< HEAD
        'matricula',
        'marca',
        'modelo',
        'capacidad',
        'año',
        'disponible',
        'Activo'
    ];
=======
        'id_vehiculo',
    'matricula', 
    'marca', 
    'modelo', 
    'capacidad', 
    'año', 
    'disponible', 
    'Activo'
];
>>>>>>> a65c80722b59f39a93251d94984bd0352ed1ffc2
}
