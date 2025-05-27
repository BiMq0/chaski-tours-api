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
    public function selectMail($mail){
        $turistas = Turista::where('correo_electronico', '=',$mail)->get();
        return response()->json($turistas->all());
    }
    public function registrar(Request $request){
        try{
            $turista = Turista::create([
            'correo_electronico' => $request->correo_electronico,
            'contrasenia' => $request->contrasenia,
            'documento' => $request->documento,
            'nombre' => $request->nombre,
            'ap_pat' => $request->ap_pat,
            'ap_mat' => $request->ap_mat,
            'fecha_nac' => $request->fecha_nac,
            'nacionalidad' => $request->nacionalidad,
            'prefijo_telefonico' => $request->prefijo_telefonico,
            'telefono' => $request->telefono
        ]);

        return response()->json($turista, 201);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el turista: ' . $e->getMessage()], 500);
        }
    }
}
