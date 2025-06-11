<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class VisitanteController extends Controller
{
    // Listar todos los visitantes
    public function selectAll()
    {
        try {
            $visitantes = Visitante::all();
            return response()->json(['data' => $visitantes], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    // Mostrar un visitante por código
    public function selectId($cod)
    {
        try {
            $visitante = Visitante::findOrFail($cod);
            return response()->json(['data' => $visitante], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Visitante no encontrado'], 404);
        }
    }

    // Crear nuevo visitante
    public function crear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo_visitante' => 
            'required|in:Turista,
            Institucion',
            'Activo' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $visitante = Visitante::create($request->all());
            return response()->json(['data' => $visitante], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Actualizar visitante
    public function actualizar(Request $request, $cod)
    {
        try {
            $visitante = Visitante::find($cod);

            if (!$visitante) {
                return response()->json(['mensaje' => 'Visitante no encontrado'], 404);
            }

            $validador = Validator::make($request->all(), [
                'tipo_visitante' => 'sometimes|required|in:Turista,Institucion',
                'Activo' => 'boolean'
            ]);

            if ($validador->fails()) {
                return response()->json(['errores' => $validador->errors()], 422);
            }

            $visitante->update($request->all());

            return response()->json(['mensaje' => 'Visitante actualizado correctamente', 'visitante' => $visitante]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    // Eliminar visitante
    public function eliminar($cod)
    {
        try {
            $visitante = Visitante::find($cod);

            if (!$visitante) {
                return response()->json(['mensaje' => 'Visitante no encontrado'], 404);
            }

            $visitante->delete();

            return response()->json(['mensaje' => 'Visitante eliminado correctamente']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }
}
