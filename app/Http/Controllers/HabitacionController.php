<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Alojamiento;
use Laravel\Prompts\Concerns\Fallback;

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

    //mostrar habitaciones de un alojamiento
    public function habitacionesParaDataGrid($id_alojamiento)
    {
        try {
            // Verificar si el alojamiento existe
            $alojamiento = Alojamiento::find($id_alojamiento);

            if (!$alojamiento) {
                return response()->json(['error' => 'Alojamiento no encontrado'], 404);
            }

            // Obtener las habitaciones con campos específicos
            $habitaciones = Habitacion::where('id_alojamiento', $id_alojamiento)
                ->select([
                    'nro_habitacion',  // Número visible al usuario
                    'tipo_habitacion',
                    'capacidad',
                    'disponible'
                ])
                ->get()
                ->map(function ($habitacion) {
                    return [
                        'nro' => $habitacion->nro_habitacion,  // Clave "nro" para el frontend
                        'tipo' => $habitacion->tipo_habitacion,
                        'capacidad' => $habitacion->capacidad,
                        'disponible' => $habitacion->disponible ? 'Disponible' : 'Ocupada', // Formato legible
                        'disponible_raw' => (bool) $habitacion->disponible
                    ];
                });

            return response()->json([
                'alojamiento' => $alojamiento->nombre_aloj,
                'nro_estrellas' => $alojamiento->nro_estrellas,
                'data' => $habitaciones // Estructura optimizada para DataGrid
            ]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor: ' . $e->getMessage()], 500);
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
    //actualiza habitacion
    public function actualizaHabitacion(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nro_habitacion' => 'required|integer',
            'id_alojamiento' => 'required|integer|exists:Alojamiento,id_alojamiento',
            'disponible' => 'required|boolean',
        ]);

        if ($validador->fails()) {
            return response()->json(['errores' => $validador->errors()], 422);
        }

        $habitacion = Habitacion::where('nro_habitacion', $request->nro_habitacion)
            ->where('id_alojamiento', $request->id_alojamiento)
            ->first();

        if (!$habitacion) {
            return response()->json(['mensaje' => 'Habitación no encontrada'], 404);
        }

        $habitacion->disponible = $request->disponible;
        $habitacion->save();

        return response()->json(['mensaje' => 'Habitación actualizada correctamente', 'habitacion' => $habitacion]);
    }


    // Eliminar una habitación
    public function eliminar($id)
    {
        try {
            $habitacion = Habitacion::find($id);
            $habitacion->disponible = false;
            $habitacion->save();
            return response()->json(['mensaje' => 'Habitación eliminada correctamente']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }
}
