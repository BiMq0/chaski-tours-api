<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Ubicacion extends Model
{
    protected $table = 'Ubicacion';
    protected $fillable = [
        'departamento',
        'municipio',
        'zona',
        'calle',
        'latitud',
        'longitud'
    ];
}
