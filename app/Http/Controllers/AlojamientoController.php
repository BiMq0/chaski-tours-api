<?php

namespace App\Http\Controllers;
use App\Models\Alojamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AlojamientoController extends Controller{
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
                'nro_habitacion' => 'required|integer|min:1',
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

    // Eliminar un alojamiento
    public function eliminar($id)
    {
        try {
            $alojamiento = Alojamiento::find($id);

            if (!$alojamiento) {
                return response()->json(['mensaje' => 'Alojamiento no encontrado'], 404);
            }

            $alojamiento->delete();

            return response()->json(['mensaje' => 'Alojamiento eliminado correctamente']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }
}
