<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turista extends Model
{
    protected $table = "Turistas";
    
    protected $fillable = [
        'correo_electronico',
        'contrasenia',
        'documento',
        'nombre',
        'ap_pat',
        'ap_mat',
        'fecha_nac',
        'nacionalidad',
        'telefono'
    ];
}
