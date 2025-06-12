<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;
use Validator;

class UbicacionController extends Controller
{
        public function selectAll(){
        $imagenes = Ubicacion::all();
        return response()->json($imagenes);
    }
    public function selectDepartamento($departamento){
        try{
            $ubicaciones = Ubicacion::where('departamento', $departamento)->get();
            return response()->json($ubicaciones);
        }catch(\Exception $ex){
            return response()->json(['error' => 'Error al encontrar el departamento: ' . $ex->getMessage()], 401);
        }
    }
    public function crear(Request $request){
        $validator = Validator::make($request->all(), [
            'departamento' => 'required|string|max:50',
            'municipio' => 'required|string|max:50',
            'zona' => 'nullable|string|max:50',
            'calle' => 'nullable|string|max:100',
            'latitud' => 'required|numeric|between:-90,90',
            'longitud' => 'required|numeric|between:-180,180'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $ubicaciones = Ubicacion::create([
            'departamento' => $request->departamento,
            'municipio' => $request->municipio,           
            'zona' => $request->zona,
            'calle' => $request->calle,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);
        return response()->json($ubicaciones, 201);
        }catch (\Exception $ex) {
            return response()->json(['error' => 'Error al añadir ubicación: ' . $ex->getMessage()], status: 500);
        }
    }

    public function actualizar(Request $request, $id_ubicacion){
        try{
            $ubicaciones = Ubicacion::find($id_ubicacion);
            $request->departamento ? $ubicaciones->id_sitio = $request->id_sitio : null;
            $request->municipio ? $ubicaciones->municipio = $request->municipio : null;          
            $request->zona ? $ubicaciones->zona = $request->zona : null;
            $request->calle ? $ubicaciones->calle = $request->calle : null;
            $request->latitud ? $ubicaciones->latitud = $request->latitud : null;
            $request->longitud ? $ubicaciones->longitud = $request->longitud : null;
            $ubicaciones->save();
            return response()->json($ubicaciones, 200);
        }catch (\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }

    public function borrar($id_ubicacion){
        try{
            $ubicaciones = Ubicacion::find($id_ubicacion);
            $ubicaciones->delete();
            return response()->json(['message'=>'Ubicación Eliminada', 'code'=>'200'], 200);
        }catch(\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }
}
