<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VisitanteController extends Controller
{
    // Listar todos los visitantes
    public function selectAll()
    {
        $visitantes = DB::table('Visitantes')->get();

        foreach ($visitantes as $v) {
            if ($v->tipo_visitante === 'Turista') {
                $turista = DB::table('Turistas')->where('cod_visitante', $v->cod_visitante)->first();
                $v->nombre_completo = $turista ? ($turista->nombre . ' ' . $turista->ap_pat . ' ' . ($turista->ap_mat ?? '')) : 'Sin nombre';
            } else if ($v->tipo_visitante === 'Institucion') {
                $institucion = DB::table('Instituciones')->where('cod_visitante', $v->cod_visitante)->first();
                $v->nombre_completo = $institucion ? $institucion->nombre : 'Sin nombre';
            }
        }

        return response()->json($visitantes);
    }

    // Mostrar un visitante por código
    public function selectId($cod)
    {
        try {
            $visitante = Visitante::find($cod);

            if (!$visitante) {
                return response()->json(['mensaje' => 'Visitante no encontrado'], 404);
            }

            return response()->json($visitante);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
        }
    }

    // Crear nuevo visitante
    public function crear(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'cod_visitante' => 'required|string|max:10|unique:Visitantes,cod_visitante',
                'tipo_visitante' => 'required|in:Turista,Institucion',
                'Activo' => 'boolean'
            ]);

            if ($validador->fails()) {
                return response()->json(['errores' => $validador->errors()], 422);
            }

            $visitante = Visitante::create($request->all());

            return response()->json([
                'mensaje' => 'Visitante creado correctamente',
                'visitante' => $visitante
            ], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error del servidor'], 500);
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
