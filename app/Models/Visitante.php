<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Visitante extends Model
{
    protected $table = 'Visitantes';
    protected $primaryKey = 'cod_visitante';
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'cod_visitante',
        'tipo_visitante',
        'Activo'
    ];
}


