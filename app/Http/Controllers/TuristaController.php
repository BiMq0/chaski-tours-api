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
    public function registrar(Request $request){
        try{
            $turista = Turista::create([
            'correo_electronico' => $request->input('correo_electronico'),
            'contrasenia' => $request->input('contrasenia'),
            'documento' => $request->input('documento'),
            'nombre' => $request->input('nombre'),
            'ap_pat' => $request->input('ap_pat'),
            'ap_mat' => $request->input('ap_mat'),
            'fecha_nac' => $request->input('fecha_nac'),
            'nacionalidad' => $request->input('nacionalidad'),
            'prefijo_telefonico' => $request->input('prefijo_telefonico'),
            'telefono' => $request->input('telefono')
        ]);

        return response()->json($turista, 201);
        
        }catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el turista: ' . $e->getMessage()], 500);
        }
    }
}
