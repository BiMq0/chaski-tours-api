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
        $turistas = Turista::find($mail);
        return response()->json($turistas);
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

    public function actualizar(Request $request, $mail){
        try{
            $turista = Turista::find($mail);
            /* $turista->cod_visitante = $request->cod_visitante;
            $turista->documento = $request->documento;
            $turista->correo_electronico = $request->correo_electronico; */
            $turista->contrasenia = $request->contrasenia;
            $turista->nombre = $request->nombre;
            $turista->ap_pat = $request->ap_pat;
            $turista->ap_mat = $request->ap_mat;
            /* $turista->fecha_nac = $request->fecha_nac;
            $turista->nacionalidad = $request->nacionalidad;
            $turista->prefijo_telefonico = $request->prefijo_telefonico;
            $turista->telefono = $request->telefono; */
            //$turista->save();
            return response()->json($turista, 200);
        }catch (\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }
}
