<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Institucion extends Model
{
    protected $table = 'Instituciones';
    protected $primaryKey = 'cod_visitante';
    public $incrementing = false; 
    protected $keyType = 'string';    
    public $timestamps = true;
    protected $fillable = [ 
        'nombre', 
        'correo_electronico', 
        'contrasenia', 
        'nacionalidad', 
        'telefono', 
        'nombre_represent', 
        'ap_pat_represent', 
        'correo_electronico_represent', 
        'telefono_represent'
    ];
    public function visitante()
    {
        return $this->belongsTo(Visitante::class, 'cod_visitante', 'cod_visitante');
    }
}
