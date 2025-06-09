<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario_Salidas extends Model
{
    protected $table = 'Calendario_Salidas';
    protected $primaryKey = 'id_salida';
    protected $fillable = [
        'id_tour',
        'fecha_salida',
        'fecha_regreso',
    ];

    
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour', 'id_tour');
    }
}
