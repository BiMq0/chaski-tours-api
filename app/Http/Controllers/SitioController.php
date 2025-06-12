<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sitio;
use Validator;

class SitioController extends Controller
{
    public function selectAll(){
        $sitios = Sitio::all();
        return response()->json($sitios);
    }
    public function selectId($id){
        try{
            $sitio = Sitio::find($id);
            return response()->json($sitio);
        }catch(\Exception $e){
            return response()->json(['error' => 'Error al consultar el sitio: ' . $e->getMessage()], 500);
        }
    }
    public function registrar(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:30',
            'desc_conceptual_sitio' => 'required|string',
            'desc_historica_sitio' => 'required|string',
            'costo_sitio' => 'required|numeric|min:0',
            'id_ubicacion' => 'required|integer|exists:ubicacion,id_ubicacion',
            'temporada_recomendada' => 'nullable|in:Primavera,Verano,Otoño,Invierno',
            'recomendacion_climatica' => 'nullable|string',
            'horario_apertura' => 'nullable|date_format:H:i',
            'horario_cierre' => 'nullable|date_format:H:i',
            'Activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $sitio = Sitio::create($request->all());
            return response()->json($sitio, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el sitio: ' . $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $id){
        try{
            $sitio = Sitio::find($id);
            $request->nombre ? $sitio->nombre = $request->nombre : null;
            $request->desc_conceptual_sitio ? $sitio->desc_conceptual_sitio = $request->desc_conceptual_sitio : null;
            $request->desc_historica_sitio ? $sitio->desc_historica_sitio = $request->desc_historica_sitio : null;
            $request->costo_sitio ? $sitio->costo_sitio = $request->costo_sitio : null;
            $request->id_ubicacion ? $sitio->id_ubicacion = $request->id_ubicacion : null;
            $request->temporada_recomendada ? $sitio->temporada_recomendada = $request->temporada_recomendada : null;
            $request->recomendacion_climatica ? $sitio->recomendacion_climatica = $request->recomendacion_climatica : null;
            $request->horario_apertura ? $sitio->horario_apertura = $request->horario_apertura : null;
            $request->horario_cierre ? $sitio->horario_cierre = $request->horario_cierre : null;
            $sitio->save();
            return response()->json($sitio, 200);
        }catch (\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }

    public function eliminar($id){
        try{
            $sitio = Sitio::find($id);
            $sitio->delete();
            return response()->json(['message'=>'Sitio Eliminado', 'code'=>'200'], 200);
        }catch(\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }
}
