<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;

class RutaController extends Controller
{
    public function selectAll(){
        $ruta = Ruta::all();
        return response()->json($ruta);
    }

    public function selectId($idtour, $idsitio){
        try{
            $ruta = Ruta::where('id_tour',$idtour)->where('id_sitio',$idsitio)->first();
                if (!$ruta) {
                    return response()->json(['mensaje' => 'Ruta no encontrada'], 404);
                }
            return response()->json($ruta);
        }catch(\Exception $e){
            return response()->json(['error' => 'Error al consultar la ruta: ' . $e->getMessage()], 500);
        }
    }

    public function crear(Request $request){
        try{
            $ruta = Ruta::create([
                'id_tour' => $request->id_tour,
                'id_sitio' => $request->id_sitio,
                'orden' => $request->orden,
            ]);

            return response()->json($ruta, 201);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar la ruta: ' . $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $idtour, $idsitio){
    try {
        $ruta = Ruta::where('id_tour', $idtour)
                        ->where('id_sitio', $idsitio)
                        ->update([
                            'orden' => $request->orden
                        ]);

        if ($ruta === 0) {
            return response()->json(['mensaje' => 'Ruta no encontrada o sin cambios'], 404);
        }

        return response()->json($ruta, 200);
    } catch (\Exception $ex) {
        return response()->json(['error' => $ex->getMessage()], 500);
    }
    }

    public function eliminar($idtour, $idsitio) {
        try {
        $ruta = Ruta::where('id_tour', $idtour)
                    ->where('id_sitio', $idsitio)
                    ->delete();

        if ($ruta===0) {
            return response()->json(['mensaje' => 'Ruta no encontrada'], 404);
        }

        return response()->json(['mensaje' => 'Ruta eliminada'], 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
