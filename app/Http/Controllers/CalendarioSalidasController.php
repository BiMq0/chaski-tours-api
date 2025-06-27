<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendario_Salidas; 
use Illuminate\Support\Facades\Validator;

class CalendarioSalidasController extends Controller
{
    
    public function selectAll()
    {
        try {
            $salidas = Calendario_Salidas::all();
            return response()->json($salidas, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }

    }

    // Mostrar una salida por id_salida
    public function selectId($id_salida)
    {
        try {
            $salida = Calendario_Salidas::find($id_salida);
            if (!$salida) {
                return response()->json(['error' => 'Salida no encontrada'], 404);
            }
            return response()->json($salida, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error interno del servidor', 'message' => $e->getMessage()], 500);
        }
    }

    // Crear una nueva salida
    public function crear(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'id_tour' => 'required|integer|exists:Tour,id_tour',
            'fecha_salida' => 'required|date',
            'fecha_regreso' => 'required|date|after:fecha_salida',
        ]);

        if ($validacion->fails()) {
            return response()->json(['errores' => $validacion->errors()], 400);
        }

        try {
            $salida = Calendario_Salidas::create($request->all());
            return response()->json($salida, 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Actualizar una salida
    public function actualizar(Request $request, $id_salida)
    {
        $salida = Calendario_Salidas::find($id_salida);
        if (!$salida) {
            return response()->json(['error' => 'Salida no encontrada'], 404);
        }

        $validacion = Validator::make($request->all(), [
            'id_tour' => 'sometimes|required|integer|exists:Tour,id_tour',
            'fecha_salida' => 'sometimes|required|date',
            'fecha_regreso' => 'sometimes|required|date|after:fecha_salida',
        ]);

        if ($validacion->fails()) {
            return response()->json(['errores' => $validacion->errors()], 400);
        }

        try {
            $datos = $request->all();
            $salida->update($datos);
            return response()->json($salida, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Eliminar una salida
    public function eliminar($id_salida)
    {
        try {
            $salida = Calendario_Salidas::find($id_salida);
            if (!$salida) {
                return response()->json(['error' => 'Salida no encontrada'], 404);
            }
            $salida->delete();
            return response()->json(['mensaje' => 'Salida eliminada correctamente'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}
