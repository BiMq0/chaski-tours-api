<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Ubicacion extends Model
{
    protected $table = 'Ubicacion';
<<<<<<< HEAD
    protected $fillable = [
        'departamento',
        'municipio',
        'zona',
        'calle',
        'latitud',
        'longitud'
    ];
=======
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
>>>>>>> a65c80722b59f39a93251d94984bd0352ed1ffc2
}
