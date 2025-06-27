<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transporte;

class TransporteController extends Controller
{
    public function selectAll(){
        $transporte = Transporte::all();
        return response()->json($transporte);
    }

    public function selectId($id){
        try{
            $transporte = Transporte::find($id);
            return response()->json($transporte);
        }catch(\Exception $e){
            return response()->json(['error' => 'Error al consultar el Transporte: ' . $e->getMessage()], 500);
        }
    }

    public function crear(Request $request){
        try{
            $transporte = Transporte::create([
                'matricula' => $request->matricula, 
                'marca' => $request->marca, 
                'modelo' => $request->modelo, 
                'capacidad' => $request->capacidad, 
                'año' => $request->año, 
                'disponible' => $request->disponible, 
                'Activo'=> $request->Activo
            ]);

            return response()->json($transporte, 201);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el Transporte: ' . $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $id){
    try{
        $transporte = Transporte::find($id);
        $request->matricula ? $transporte->matricula = $request->matricula : null;
        $request->marca ? $transporte->marca = $request->marca : null;
        $request->modelo ? $transporte->modelo = $request->modelo : null;
        $request->capacidad ? $transporte->capacidad = $request->capacidad : null;
        $request->año ? $transporte->año = $request->año : null;
        $transporte->disponible = $request->input('disponible', $transporte->disponible);
        $transporte->Activo = $request->input('Activo', $transporte->Activo);
        $transporte->save();
        return response()->json($transporte, 200);
    }catch (\Exception $ex){
        return response()->json(['error' => $ex->getMessage()], 500);
    }
    }

    public function eliminar($id){
        try{
            $transporte = Transporte::find($id);

            if (!$transporte) {
                return response()->json(['mensaje' => 'reserva no encontrada'], 404);
            }
            if ($transporte->estado === false) {
                return response()->json(['mensaje' => 'La reserva ya está cancelada'], 400);
            }
            $transporte->update(['Activo' => false]);
            return response()->json([
                'mensaje' => 'transporte cancelado correctamente',
                'transporte' => $transporte, 'code'=>'200'], 200
            );
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
