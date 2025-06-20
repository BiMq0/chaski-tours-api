<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Reserva extends Model
{
    public $timestamps = false;
    protected $table = 'Reserva';
    protected $fillable = [
        'cod_visitante', 
        'id_alojamiento',
        'id_salida', 
        'cantidad_personas', 
        'costo_total_reserva', 
        'estado'
    ];
}
