<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    public function selectAll(){
        $imagenes = Ubicacion::all();
        return response()->json($imagenes);
    }

    public function selectId($id){
        try{
            $ubicaciones = Ubicacion::where('id_ubicacion', $id)->get();
            return response()->json($ubicaciones);
        }catch(\Exception $ex){
            return response()->json(['error' => 'Error al encontrar la ubicación: ' . $ex->getMessage()], 401);
        }
    }

    public function crear(Request $request){
        try{
            $ubicacion = Ubicacion::create([
            'departamento' => $request->departamento,
            'municipio' => $request->municipio,           
            'zona' => $request->zona,
            'calle' => $request->calle,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);
        return response()->json($ubicacion, 201);
        }catch (\Exception $ex) {
            return response()->json(['error' => 'Error al añadir ubicación: ' . $ex->getMessage()], status: 500);
        }
    }

    public function actualizar(Request $request, $id_ubicacion){
        try{
            $ubicacion = Ubicacion::find($id_ubicacion);
            $request->departamento ? $ubicacion->departamento = $request->departamento : null;
            $request->municipio ? $ubicacion->municipio = $request->municipio : null;          
            $request->zona ? $ubicacion->zona = $request->zona : null;
            $request->calle ? $ubicacion->calle = $request->calle : null;
            $request->latitud ? $ubicacion->latitud = $request->latitud : null;
            $request->longitud ? $ubicacion->longitud = $request->longitud : null;
            $request->created_at ? $ubicacion->created_at = $request->created_at : null;
            $request->updated_at ? $ubicacion->updated_at = $request->updated_at : null;
            $ubicacion->save();
            return response()->json($ubicacion, 200);
        }catch (\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }

    public function eliminar($id_ubicacion){
        try{
            $ubicaciones = Ubicacion::find($id_ubicacion);
            $ubicaciones->delete();
            return response()->json(['message'=>'Ubicación Eliminada', 'code'=>'200'], 200);
        }catch(\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }
}
