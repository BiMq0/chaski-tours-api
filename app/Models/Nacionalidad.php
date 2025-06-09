<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table = "Nacionalidades";
    protected $fillable = ['nacionalidad', 'prefijo_telefonico'];
    public function turistas()
    {
        return $this->hasMany(Turista::class, 'nacionalidad', 'nacionalidad');
    }

    public function instituciones()
    {
        return $this->hasMany(Institucion::class, 'nacionalidad', 'nacionalidad');
    }
}
