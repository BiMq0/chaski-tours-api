<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table = 'Nacionalidades';
    protected $fillable = [
    'nacionalidad', 
    'prefijo_telefonico', 
    'Activo'
    ];
}
