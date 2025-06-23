<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Habitacion;

class AlojamientoController extends Controller
{
    // Obtener todos los alojamientos
    public function selectAll()
    {
        try {
            $alojamientos = Alojamiento::all();
            return response()->json($alojamientos);
        } catch (\Throwable  $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    // Mostrar un alojamiento específico
    public function selectId($id)
    {
        try {
            $alojamiento = Alojamiento::find($id);

            if (!$alojamiento) {
                return response()->json(['mensaje' => 'Alojamiento no encontrado'], 404);
            }

            return response()->json($alojamiento);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    // Crear nuevo alojamiento
    public function crear(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'nombre_aloj' => 'required|string|max:25',
                'nro_estrellas' => 'required|numeric|min:0',
                'nro_habitaciones' => 'required|integer|min:1',
                'Activo' => 'boolean'
            ]);

            if ($validador->fails()) {
                return response()->json(['errores' => $validador->errors()], 422);
            }

            $alojamiento = Alojamiento::create($request->all());

            return response()->json(['mensaje' => 'Alojamiento creado exitosamente', 'alojamiento' => $alojamiento], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    // Actualizar un alojamiento existente
    public function actualizar(Request $request, $id)
    {
        try {
            $alojamiento = Alojamiento::find($id);

            if (!$alojamiento) {
                return response()->json(['mensaje' => 'Alojamiento no encontrado'], 404);
            }

            $validador = Validator::make($request->all(), [
                'nombre_aloj' => 'sometimes|required|string',
                'nro_estrellas' => 'sometimes|required|numeric',
                'nro_habitaciones' => 'sometimes|required|integer',
                'Activo' => 'boolean'
            ]);

            if ($validador->fails()) {
                return response()->json(['errores' => $validador->errors()], 422);
            }

            $alojamiento->update($request->all());

            return response()->json(['mensaje' => 'Alojamiento actualizado correctamente', 'alojamiento' => $alojamiento]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    public function desactivar($id)
    {
        try {
            $alojamiento = Alojamiento::find($id);

            if (!$alojamiento) {
                return response()->json(['mensaje' => 'Alojamiento no encontrado'], 404);
            }

            // Verificar si ya está inactivo
            if ($alojamiento->Activo === false) {
                return response()->json(['mensaje' => 'El alojamiento ya está inactivo'], 400);
            }

            // Actualizar el estado a inactivo
            $alojamiento->update(['Activo' => false]);

            return response()->json([
                'mensaje' => 'Alojamiento desactivado correctamente',
                'alojamiento' => $alojamiento
            ]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor: ' . $e->getMessage()], 500);
        }
    }

    //funcionalidad para agregar las habitaciones y registro de alojamiento
    public function crearConHabitaciones(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre_aloj' => 'required|string|max:25',
            'nro_estrellas' => 'required|numeric|min:0',
            'nro_habitaciones' => 'required|integer|min:1',
            'Activo' => 'boolean',
            'habitaciones' => 'required|array|min:1',
            'habitaciones.*.tipo_habitacion' => 'required|in:Individual,Doble,Suite,Familiar',
            'habitaciones.*.capacidad' => 'required|integer|min:1',
            'habitaciones.*.disponible' => 'boolean'
        ]);

        if ($validador->fails()) {
            return response()->json(['errores' => $validador->errors()], 422);
        }

        try {
            DB::beginTransaction();

            // Crear alojamiento
            $alojamiento = Alojamiento::create([
                'nombre_aloj' => $request->nombre_aloj,
                'nro_estrellas' => $request->nro_estrellas,
                'nro_habitaciones' => $request->nro_habitaciones,
                'Activo' => $request->Activo ?? true,
            ]);

            // Crear habitaciones asociadas
            foreach ($request->habitaciones as $hab) {
                Habitacion::create([
                    'id_alojamiento' => $alojamiento->id_alojamiento,
                    'tipo_habitacion' => $hab['tipo_habitacion'],
                    'capacidad' => $hab['capacidad'],
                    'disponible' => $hab['disponible'] ?? true,
                    // nro_habitacion lo genera el trigger
                ]);
            }

            DB::commit();

            return response()->json([
                'mensaje' => 'Alojamiento y habitaciones creados exitosamente',
                'alojamiento' => $alojamiento
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error del servidor: ' . $e->getMessage()
            ], 500);
        }
    }
}
