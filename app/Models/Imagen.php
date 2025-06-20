<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Imagen extends Model
{
    protected $table = 'Imagen';
    protected $fillable = [
        'id_sitio', 
        'url_img'
    ];
}
