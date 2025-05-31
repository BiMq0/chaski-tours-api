<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito_Reservas;

class CarritoReservasController extends Controller
{
    public function selectAll(){
    $carritos = Carrito_Reservas::all();
    return response()->json($carritos);
}

public function selectId($id){
    try{
        $carrito = Carrito_Reservas::find($id);
        return response()->json($carrito);
    }catch(\Exception $e){
        return response()->json(['error' => 'Error al consultar la carrito: ' . $e->getMessage()], 500);
    }
}

public function crear(Request $request){
    try{
        $carrito = Carrito_Reservas::create([
            'cod_visitante' => $request->cod_visitante,
            'id_alojamiento' => $request->id_alojamiento,
            'id_salida' => $request->id_salida,
            'cantidad_personas' => $request->cantidad_personas,
            'costo_total_carrito' => $request->costo_total_carrito
        ]);

        return response()->json($carrito, 201);
    }catch (\Exception $e) {
        return response()->json(['error' => 'Error al registrar la carrito: ' . $e->getMessage()], 500);
    }
}

public function actualizar(Request $request, $id){
    try{
        $carrito = Carrito_Reservas::find($id);
        $request->id_reserva ? $carrito->id_reserva = $request->id_reserva : null;
        $request->cod_visitante ? $carrito->cod_visitante = $request->cod_visitante : null;
        $carrito->save();
        return response()->json($carrito, 200);
    }catch (\Exception $ex){
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}

public function eliminar($id){
    try{
        $carrito = Carrito_Reservas::find($id);
        $carrito->delete();
        return response()->json(['message'=>'carrito Eliminada', 'code'=>'200'], 200);
    }catch(\Exception $ex){
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}
}
