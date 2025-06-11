<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nacionalidad extends Model
{
    protected $table = 'Nacionalidades';
    protected $primaryKey = 'nacionalidad';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nacionalidad',
        'prefijo_telefonico'
    ];

    // Relación 1:N con Turista
    public function turistas()
    {
        return $this->hasMany(Turista::class, 'nacionalidad', 'nacionalidad');
    }

    // Relación 1:N con Institucion
    public function instituciones()
    {
        return $this->hasMany(Institucion::class, 'nacionalidad', 'nacionalidad');
    }
}
