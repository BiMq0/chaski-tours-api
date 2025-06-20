<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sitio;

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
    public function crear(Request $request){
        try{
            $sitio = Sitio::create([
            'nombre' => $request->nombre,
            'desc_conceptual_sitio' => $request->desc_conceptual_sitio,
            'desc_historica_sitio' => $request->desc_historica_sitio,
            'temporada_recomendada' => $request->temporada_recomendada,
            'recomendacion_climatica' => $request->recomendacion_climatica,
            'costo_sitio' => $request->costo_sitio,
            'id_ubicacion' => $request->id_ubicacion,
            'horario_apertura' => $request->horario_apertura,
            'horario_cierre' => $request->horario_cierre,
            'Activo' => $request->activo,
        ]);

        return response()->json($sitio, 201);
        }catch (\Exception $e) {
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
