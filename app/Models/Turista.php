<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turista extends Model
{
    public $timestamps = false;

    protected $table = "Turistas";
    
    protected $fillable = [
        'cod_visitante',
        'correo_electronico',
        'contrasenia',
        'documento',
        'nombre',
        'ap_pat',
        'ap_mat',
        'fecha_nac',
        'nacionalidad',
        'prefijo_telefonico',
        'telefono'
    ];
}
