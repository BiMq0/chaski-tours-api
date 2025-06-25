<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function selectAll(){
        $tour = Tour::all();
        return response()->json($tour);
    }

    public function selectId($id){
        try{
            $tour = Tour::find($id);
            return response()->json($tour);
        }catch(\Exception $e){
            return response()->json(['error' => 'Error al consultar el tour: ' . $e->getMessage()], 500);
        }
    }

    public function crear(Request $request){
        try{
            $tour = Tour::create([
                'nombre_tour' => $request->nombre_tour, 
                'descripcion_tour'=> $request->descripcion_tour,
                'costo_tour'=> $request->costo_tour, 
                'id_sitio_inicio'=> $request->id_sitio_inicio, 
                'id_sitio_fin'=> $request->id_sitio_fin, 
                'duracion_dias'=> $request->duracion_dias, 
                'duracion_noches'=> $request->duracion_noches,
                'id_alojamiento'=> $request->id_alojamiento, 
                'Activo'=> $request->Activo
            ]);

            return response()->json($tour, 201);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el tour: ' . $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $id){
    try{
        $tour = Tour::find($id);
       if (!$tour) {
            return response()->json(['error' => 'Tour no encontrado'], 404);
        }
        $tour->nombre_tour = $request->nombre_tour ?? $tour->nombre_tour;
        $tour->descripcion_tour = $request->descripcion_tour ?? $tour->descripcion_tour;
        $tour->costo_tour = $request->costo_tour ?? $tour->costo_tour;
        $tour->id_sitio_inicio = $request->id_sitio_inicio ?? $tour->id_sitio_inicio;
        $tour->id_sitio_fin = $request->id_sitio_fin ?? $tour->id_sitio_fin;
        $tour->duracion_dias = $request->duracion_dias ?? $tour->duracion_dias;
        $tour->duracion_noches = $request->duracion_noches ?? $tour->duracion_noches;
        $tour->id_alojamiento = $request->id_alojamiento ?? $tour->id_alojamiento;
        if ($request->has('Activo')) {
            $tour->Activo = $request->Activo;
        }
        $tour->save();
        return response()->json($tour, 200);
    }catch (\Exception $ex){
        return response()->json(['error' => $ex->getMessage()], 500);
    }
    }

    public function eliminar($id){
        try{
            $tour = Tour::find($id);
            $tour->delete();
            return response()->json(['message'=>'Tour Eliminado', 'code'=>'200'], 200);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
