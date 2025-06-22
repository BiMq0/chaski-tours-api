<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turista extends Model
{
    protected $primaryKey = 'cod_visitante';
    public $incrementing = false; // Si no es auto incremental
    protected $keyType = 'string'; // Si es tipo string como 'tru25'

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
