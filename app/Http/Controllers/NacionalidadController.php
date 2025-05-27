<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nacionalidad; 

class NacionalidadController extends Controller
{
    public function selectAll()
    {
        return response()->json(Nacionalidad::all());
    }
}
