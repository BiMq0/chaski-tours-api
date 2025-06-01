<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table = 'Ruta';
    protected $fillable = [
     'id_tour',
     'id_sitio',
     'orden'
    ];
    protected $primaryKey = null;      
    public $incrementing = false;      
    public $timestamps = true;    
}
