<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Sitio_Categoria extends Model
{
    protected $table = 'Sitio_Categoria';
    protected $fillable = ['nombre_categoria','id_sitio'];
}
