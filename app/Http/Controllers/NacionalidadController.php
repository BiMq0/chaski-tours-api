<?php

namespace App\Http\Controllers;
    
use App\Models\Nacionalidad;
use Illuminate\Http\Request;

class NacionalidadController extends Controller
{
    public function selectAll(){
        return response()->json(Nacionalidad::all(), 200);
    }
}
