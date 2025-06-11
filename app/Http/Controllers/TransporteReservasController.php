<?php

namespace App\Http\Controllers;
use App\Models\Transporte_Reservas;
use App\Models\Transporte;
use App\Models\Reserva;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TransporteReservasController extends Controller
{
  
    public function selectAll()
    {
        try {
            $transporteReservas = Transporte_Reservas::with(['transporte', 'reserva'])->get();
            return response()->json(['data' => $transporteReservas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_vehiculo' => 'required|integer|exists:Transporte,id_vehiculo',
            'id_reserva' => 'required|integer|exists:Reserva,id_reserva',
            'fecha' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Verificar que el vehículo esté disponible
            $transporte = Transporte::findOrFail($request->id_vehiculo);
            if (!$transporte->disponible || !$transporte->Activo) {
                return response()->json(['error' => 'El vehículo no está disponible'], 400);
            }

            // Verificar que la reserva exista
            $reserva = Reserva::findOrFail($request->id_reserva);

            $transporteReserva = Transporte_Reservas::create($request->all());
            
            return response()->json([
                'message' => 'Asignación de transporte creada correctamente',
                'data' => $transporteReserva
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function selectId($id)
    {
        try {
            $transporteReserva = Transporte_Reservas::with(['transporte', 'reserva'])->findOrFail($id);
            return response()->json(['data' => $transporteReserva], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Asignación no encontrada'], 404);
        }
    }

    /**
     * Actualiza una asignación existente
     */
    public function Actualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_vehiculo' => 'integer|exists:Transporte,id_vehiculo',
            'id_reserva' => 'integer|exists:Reserva,id_reserva',
            'fecha' => 'date'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $transporteReserva = Transporte_Reservas::findOrFail($id);
            
            // Verificar disponibilidad del vehículo si se cambia
            if ($request->has('id_vehiculo')) {
                $transporte = Transporte::findOrFail($request->id_vehiculo);
                if (!$transporte->disponible || !$transporte->Activo) {
                    return response()->json(['error' => 'El vehículo no está disponible'], 400);
                }
            }

            $transporteReserva->update($request->all());
            
            return response()->json([
                'message' => 'Asignación actualizada correctamente',
                'data' => $transporteReserva
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Asignación no encontrada'], 404);
        }
    }

    public function eliminar($id)
    {
        try {
            $transporteReserva = Transporte_Reservas::findOrFail($id);
            $transporteReserva->delete();
            
            return response()->json([
                'message' => 'Asignación eliminada correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Asignación no encontrada'], 404);
        }
    }

    /**
     * Obtiene las asignaciones por vehículo
     */
    public function porVehiculo($idVehiculo)
    {
        try {
            $transporte = Transporte::findOrFail($idVehiculo);
            $asignaciones = $transporte->reservasTransporte()->with('reserva')->get();
            
            return response()->json(['data' => $asignaciones], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Vehículo no encontrado'], 404);
        }
    }

    /**
     * Obtiene las asignaciones por reserva
     */
    public function porReserva($idReserva)
    {
        try {
            $reserva = Reserva::findOrFail($idReserva);
            $asignaciones = $reserva->transportes()->with('transporte')->get();
            
            return response()->json(['data' => $asignaciones], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }
    }
}
