<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;
use Illuminate\Support\Facades\Validator;

class InstitucionController extends Controller
{
public function selectAll()
    {
        try {
            $instituciones = Institucion::all();
            return response()->json($instituciones, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function selectId($cod_visitante)
    {
        try {
            $institucion = Institucion::find($cod_visitante);
            if (!$institucion) {
                return response()->json(['error' => 'Institución no encontrada'], 404);
            }
            return response()->json($institucion, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function crear(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'correo_electronico' => 'required|email|max:50|unique:Instituciones,correo_electronico',
            'contrasenia' => 'required|string|min:6',
            'nacionalidad' => 'required|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'nombre_represent' => 'required|string|max:20',
            'ap_pat_represent' => 'required|string|max:20',
            'correo_electronico_represent' => 'required|email|max:50',
            'telefono_represent' => 'required|string|max:20',
        ]);

        if ($validacion->fails()) {
            return response()->json(['errores' => $validacion->errors()], 400);
        }

        try {
            $institucion = Institucion::create([
                'nombre' => $request->nombre,
                'correo_electronico' => $request->correo_electronico,
                'contrasenia' => $request->contrasenia, // TEXTO PLANO
                'nacionalidad' => $request->nacionalidad,
                'telefono' => $request->telefono,
                'nombre_represent' => $request->nombre_represent,
                'ap_pat_represent' => $request->ap_pat_represent,
                'correo_electronico_represent' => $request->correo_electronico_represent,
                'telefono_represent' => $request->telefono_represent,
            ]);

            $token = $institucion->createToken('api_key')->plainTextToken;

            return response()->json([
                'code' => 201,
                'data' => $institucion,
                'token' => $token
            ], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al crear la institución: ' . $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $cod_visitante)
    {
        $institucion = Institucion::find($cod_visitante);
        if (!$institucion) {
            return response()->json(['error' => 'Institución no encontrada'], 404);
        }

        $validacion = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string',
            'correo_electronico' => "sometimes|required|email|unique:Instituciones,correo_electronico,$cod_visitante,cod_visitante",
            'contrasenia' => 'sometimes|required|string',
            'nacionalidad' => 'sometimes|required|string',
            'telefono' => 'nullable|string',
            'nombre_represent' => 'sometimes|required|string',
            'ap_pat_represent' => 'sometimes|required|string',
            'correo_electronico_represent' => 'sometimes|required|email',
            'telefono_represent' => 'sometimes|required|string',
        ]);

        if ($validacion->fails()) {
            return response()->json(['errores' => $validacion->errors()], 400);
        }
        
        try {
        $datos = $request->all();
        $institucion->update($datos);
            return response()->json($institucion, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al actualizar: ' . $e->getMessage()], 500);
        }
    }

    public function eliminar($cod_visitante)
    {
        try {
            $institucion = Institucion::find($cod_visitante);
            if (!$institucion) {
                return response()->json(['error' => 'Institución no encontrada'], 404);
            }
            $institucion->delete();
            return response()->json(['mensaje' => 'Institución eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar: ' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo_electronico' => 'required|email',
            'contrasenia' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errores' => $validator->errors()], 400);
        }

        $institucion = Institucion::where('correo_electronico', $request->correo_electronico)->first();

        if (!$institucion || $institucion->contrasenia !== $request->contrasenia) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        $token = $institucion->createToken('api_key')->plainTextToken;

        return response()->json([
            'mensaje' => 'Inicio de sesión correcto',
            'data' => $institucion,
            'token' => $token
        ], 200);
    }
}
