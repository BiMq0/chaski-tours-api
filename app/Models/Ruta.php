<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table = 'Ruta';
    protected $primaryKey = ['id_tour', 'id_sitio'];

    public $incrementing = false;

    protected $fillable = [
        'id_tour',
        'id_sitio',
        'orden'
    ];
    // Relación N:1 con Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour');
    }  
    // Relación N:1 con Sitio
    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio');
    }
}
