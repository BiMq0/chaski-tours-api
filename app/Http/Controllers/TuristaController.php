<?php

namespace App\Http\Controllers;
use  App\Models\Turista;
use Illuminate\Http\Request;

class TuristaController extends Controller
{
    public function selectAll(){
        $turistas = Turista::all();
        return response()->json($turistas);
    }
    public function selectId($mail){
        $turistas = Turista::all()->where("correo_electronico", '=', $mail);
        return response()->json($turistas);
    }
}
