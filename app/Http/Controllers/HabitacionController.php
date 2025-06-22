<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HabitacionController extends Controller
{

    // Mostrar todas las habitaciones
    public function selectAll()
    {
        try {
            $habitaciones = Habitacion::all();
            return response()->json($habitaciones);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    // Mostrar una habitación por ID
    public function mostrar($id)
    {
        try {
            $habitacion = Habitacion::find($id);

            if (!$habitacion) {
                return response()->json(['mensaje' => 'Habitación no encontrada'], 404);
            }

            return response()->json($habitacion);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    // Crear una nueva habitación
    public function crear(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'id_alojamiento' => 'required|integer|exists:Alojamiento,id_alojamiento',
            'tipo_habitacion' => 'required|in:Individual,Doble,Suite,Familiar',
            'capacidad' => 'required|integer|min:1',
            'disponible' => 'boolean'
        ]);

        if ($validador->fails()) {
            return response()->json(['errores' => $validador->errors()], 422);
        }

        try {
            // No envíes nro_habitacion en el request porque lo genera el trigger
            $habitacion = new Habitacion();
            $habitacion->id_alojamiento = $request->id_alojamiento;
            $habitacion->tipo_habitacion = $request->tipo_habitacion;
            $habitacion->capacidad = $request->capacidad;
            $habitacion->disponible = $request->disponible ?? true; // por si no viene
            $habitacion->save();  // Aquí el trigger generará nro_habitacion


            return response()->json([
                'mensaje' => 'Habitación creada exitosamente',
                'habitacion' => $habitacion
            ], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor: ' . $e->getMessage()], 500);
        }
    }




    // Actualizar una habitación
    public function selectId(Request $request, $id)
    {
        try {
            $habitacion = Habitacion::find($id);

            if (!$habitacion) {
                return response()->json(['mensaje' => 'Habitación no encontrada'], 404);
            }

            $validador = Validator::make($request->all(), [
                'nro_habitacion' => 'sometimes|required|string|max:10',
                'id_alojamiento' => 'sometimes|required|integer|exists:Alojamiento,id_alojamiento',
                'tipo_habitacion' => 'sometimes|required|string|max:50',
                'capacidad' => 'sometimes|required|integer|min:1',
                'disponible' => 'boolean'
            ]);

            if ($validador->fails()) {
                return response()->json(['errores' => $validador->errors()], 422);
            }

            $habitacion->update($request->all());

            return response()->json(['mensaje' => 'Habitación actualizada correctamente', 'habitacion' => $habitacion]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    // Eliminar una habitación
    public function eliminar($id)
    {
        try {
            $habitacion = Habitacion::find($id);

            if (!$habitacion) {
                return response()->json(['mensaje' => 'Habitación no encontrada'], 404);
            }

            $habitacion->delete();

            return response()->json(['mensaje' => 'Habitación eliminada correctamente']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }
}
