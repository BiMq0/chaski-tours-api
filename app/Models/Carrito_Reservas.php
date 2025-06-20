<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Carrito_Reservas extends Model
{
    protected $table = 'Carrito_Reservas';
    protected $fillable = [
        'id_reserva',
        'cod_visitante'
    ];
}
