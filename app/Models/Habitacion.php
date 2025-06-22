<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alojamiento;
class Habitacion extends Model
{
    protected $table = 'Habitacion';

    // Ahora la PK es 'id' (auto_increment), no es necesario cambiar $primaryKey porque 'id' es por defecto
    // protected $primaryKey = 'id'; // Opcional

    public $timestamps = false;

    protected $fillable = [
        'nro_habitacion',
        'id_alojamiento',
        'tipo_habitacion',
        'capacidad',
        'disponible'
    ];

    public function alojamiento()
    {
        return $this->belongsTo(Alojamiento::class, 'id_alojamiento', 'id_alojamiento');
    }
}
