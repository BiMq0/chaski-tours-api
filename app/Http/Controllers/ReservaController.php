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
public function selectCOD($cod_visitante)
{
    try {
        $reservas = Reserva::where('cod_visitante', $cod_visitante)->get();

        if ($reservas->isEmpty()) {
            return response()->json(['message' => 'No hay reservas para este visitante'], 200);
        }

        return response()->json($reservas);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener las reservas: ' . $e->getMessage()], 500);
    }
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
        if (!$reserva) {
                return response()->json(['mensaje' => 'reserva no encontrada'], 404);
        }
        if ($reserva->estado === 'Cancelada') {
            return response()->json(['mensaje' => 'La reserva ya está cancelada'], 400);
        }
        $reserva->update(['estado' => 'Cancelada']);
        return response()->json([
            'mensaje' => 'reserva cancelada correctamente',
            'reserva' => $reserva,'code'=>'200'], 200
            );
        
    }catch(\Exception $ex){
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}
}
