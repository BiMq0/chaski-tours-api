<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function selectAll(){
    $reservas = Reserva::all();
    return response()->json($reservas);
}

public function selectId($id){
    try{
        $reserva = Reserva::find($id);
        return response()->json($reserva);
    }catch(\Exception $e){
        return response()->json(['error' => 'Error al consultar la reserva: ' . $e->getMessage()], 500);
    }
}

public function crear(Request $request){
    try{
        $reserva = Reserva::create([
            'cod_visitante' => $request->cod_visitante,
            'id_salida' => $request->id_salida,
            'cantidad_personas' => $request->cantidad_personas,
            'costo_total_reserva' => $request->costo_total_reserva
        ]);

        return response()->json($reserva, 201);
    }catch (\Exception $e) {
        return response()->json(['error' => 'Error al registrar la reserva: ' . $e->getMessage()], 500);
    }
}

public function actualizar(Request $request, $id){
    try{
        $reserva = Reserva::find($id);
        $request->cod_visitante ? $reserva->cod_visitante = $request->cod_visitante : null;
        $request->id_salida ? $reserva->id_salida = $request->id_salida : null;
        $request->cantidad_personas ? $reserva->cantidad_personas = $request->cantidad_personas : null;
        $request->costo_total_reserva ? $reserva->costo_total_reserva = $request->costo_total_reserva : null;
        $request->estado ? $reserva->estado = $request->estado : null;
        $reserva->save();
        return response()->json($reserva, 200);
    }catch (\Exception $ex){
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}

public function eliminar($id){
    try{
        $reserva = Reserva::find($id);
        $reserva->delete();
        return response()->json(['message'=>'Reserva Eliminada', 'code'=>'200'], 200);
    }catch(\Exception $ex){
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}
}
