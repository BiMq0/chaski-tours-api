<?php

namespace App\Http\Controllers;

use App\Models\Turista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TuristaController extends Controller
{
    public function selectAll()
    {
        return response()->json(Turista::all());
    }


    public function selectMail($mail)
    {
        try {
            $turista = Turista::where('correo_electronico', $mail)
                ->orWhere('cod_visitante', $mail)
                ->get();

            return response()->json($turista);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar el turista: ' . $e->getMessage()], 500);
        }
    }

    public function registrar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'cod_visitante' => 'required|unique:Turistas',
                'correo_electronico' => 'required|email|unique:Turistas',
                'contrasenia' => 'required|min:4',
                'documento' => 'required',
                'nombre' => 'required',
                'ap_pat' => 'required',
                'ap_mat' => 'required',
                'fecha_nac' => 'required|date',
                'nacionalidad' => 'required',
                'telefono' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errores' => $validator->errors()], 400);
            }

            $turista = Turista::create([
                'cod_visitante' => $request->cod_visitante,
                'correo_electronico' => $request->correo_electronico,
                'contrasenia' => $request->contrasenia, // TEXTO PLANO
                'documento' => $request->documento,
                'nombre' => $request->nombre,
                'ap_pat' => $request->ap_pat,
                'ap_mat' => $request->ap_mat,
                'fecha_nac' => $request->fecha_nac,
                'nacionalidad' => $request->nacionalidad,
                'telefono' => $request->telefono
            ]);

            $token = $turista->createToken('api_key')->plainTextToken;

            return response()->json([
                'code' => 201,
                'data' => $turista,
                'token' => $token
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el turista: ' . $e->getMessage()], 500);
        }
    }
<<<<<<< HEAD

    public function actualizar(Request $request, $cod)
    {
        try {
            $turista = Turista::find($cod);
            if (!$turista) {
                return response()->json(['error' => 'Turista no encontrado'], 404);
            }

            $turista->documento = $request->documento ?? $turista->documento;
            $turista->correo_electronico = $request->correo_electronico ?? $turista->correo_electronico;
            $turista->contrasenia = $request->contrasenia ?? $turista->contrasenia;
            $turista->nombre = $request->nombre ?? $turista->nombre;
            $turista->ap_pat = $request->ap_pat ?? $turista->ap_pat;
            $turista->ap_mat = $request->ap_mat ?? $turista->ap_mat;
            $turista->fecha_nac = $request->fecha_nac ?? $turista->fecha_nac;
            $turista->nacionalidad = $request->nacionalidad ?? $turista->nacionalidad;
            $turista->telefono = $request->telefono ?? $turista->telefono;

            $turista->save();

            return response()->json($turista, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function borrar($cod)
    {
        try {
            $turista = Turista::find($cod);
            if (!$turista) {
                return response()->json(['error' => 'Turista no encontrado'], 404);
            }

            $turista->delete();
            return response()->json(['message' => 'Usuario eliminado'], 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo_electronico' => 'required|email',
            'contrasenia' => 'required'
=======
    public function registrar(Request $request){
        try{
            $turista = Turista::create([
            'cod_visitante' => $request->cod_visitante,
            'correo_electronico' => $request->correo_electronico,
            'contrasenia' => $request->contrasenia,
            'documento' => $request->documento,
            'nombre' => $request->nombre,
            'ap_pat' => $request->ap_pat,
            'ap_mat' => $request->ap_mat,
            'fecha_nac' => $request->fecha_nac,
            'nacionalidad' => $request->nacionalidad,
            'telefono' => $request->telefono
>>>>>>> e57d38a82c709678893e7ffef0944f15dbb4fa8a
        ]);

        if ($validator->fails()) {
            return response()->json(['errores' => $validator->errors()], 400);
        }

        $turista = Turista::where('correo_electronico', $request->correo_electronico)->first();

        if (!$turista || $turista->contrasenia !== $request->contrasenia) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        $token = $turista->createToken('api_key')->plainTextToken;

        return response()->json([
            'mensaje' => 'Inicio de sesión correcto',
            'data' => $turista,
            'token' => $token
        ], 200);
    }
    //parte de autencicaccion parte sacntum

}
