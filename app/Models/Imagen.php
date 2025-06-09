<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'Imagen';
protected $fillable = ['id_sitio', 'url_img'];
 public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio');
    }
}

