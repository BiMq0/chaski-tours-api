<?php

namespace App\Http\Controllers;
use  App\Models\Turista;
use Illuminate\Http\Request;

class TuristaController extends Controller
{
    public function selectAll(){
        $turistas = Turista::all();
        return response()->json($turistas);
    }
    public function selectMail($mail){
        try{
            $turista = Turista::where('correo_electronico', $mail)->orWhere('cod_visitante', $mail)->get();
            return response()->json($turista);
        }catch(\Exception $e){
            return response()->json(['error' => 'Error al registrar el turista: ' . $e->getMessage()], 500);
        }
    }
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
        ]);

        return response()->json($turista, 201);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el turista: ' . $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $cod){
        try{
            $turista = Turista::find($cod);
            $request->documento ? $turista->documento = $request->documento : null;
            $request->correo_electronico ? $turista->correo_electronico = $request->correo_electronico : null;
            $request->contrasenia ? $turista->contrasenia = $request->contrasenia : null;
            $request->nombre ? $turista->nombre = $request->nombre : null;
            $request->ap_pat ? $turista->ap_pat = $request->ap_pat : null;
            $request->ap_mat ? $turista->ap_mat = $request->ap_mat : null;
            $request->fecha_nac ? $turista->fecha_nac = $request->fecha_nac : null;
            $request->nacionalidad ? $turista->nacionalidad = $request->nacionalidad : null;
            $request->telefono ? $turista->telefono = $request->telefono : null; 
            $turista->save();
            return response()->json($turista, 200);
        }catch (\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }

    public function borrar($cod){
        try{
            $turista = Turista::find($cod);
            $turista->delete();
            return response()->json(['message'=>'Usuario Eliminado', 'code'=>'200'], 200);
        }catch(\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }
}
