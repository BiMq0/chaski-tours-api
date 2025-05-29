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
            $turista = Turista::where('correo_electronico', $mail)->get();
            return response()->json($turista);
        }catch(\Exception $e){
            return response()->json(['error' => 'Error al registrar el turista: ' . $e->getMessage()], 500);
        }
    }
    public function registrar(Request $request){
        try{
            $turista = Turista::create([
            'correo_electronico' => $request->correo_electronico,
            'contrasenia' => $request->contrasenia,
            'documento' => $request->documento,
            'nombre' => $request->nombre,
            'ap_pat' => $request->ap_pat,
            'ap_mat' => $request->ap_mat,
            'fecha_nac' => $request->fecha_nac,
            'nacionalidad' => $request->nacionalidad,
            'prefijo_telefonico' => $request->prefijo_telefonico,
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
            $turista->documento ? $turista->documento = $request->documento : null;
            $turista->correo_electronico ? $turista->correo_electronico = $request->correo_electronico : null;
            $turista->contrasenia ? $turista->contrasenia = $request->contrasenia : null;
            $turista->nombre ? $turista->nombre = $request->nombre : null;
            $turista->ap_pat ? $turista->ap_pat = $request->ap_pat : null;
            $turista->ap_mat ? $turista->ap_mat = $request->ap_mat : null;
            $turista->fecha_nac ? $turista->fecha_nac = $request->fecha_nac : null;
            $turista->nacionalidad ? $turista->nacionalidad = $request->nacionalidad : null;
            $turista->prefijo_telefonico ? $turista->prefijo_telefonico = $request->prefijo_telefonico : null;
            $turista->telefono ? $turista->telefono = $request->telefono : null; 
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
