<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    public function selectAll(){
        $visitantes = Visitante::all();
        return response()->json($visitantes);
    }
}
