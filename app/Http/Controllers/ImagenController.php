<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Validator;

class ImagenController extends Controller
{
    public function selectAll(){
        $imagenes = Imagen::all();
        return response()->json($imagenes);
    }
    public function selectIdSitio($id_sitio){
        try {
            $imagenes = Imagen::where('id_sitio', $id_sitio)->get();
            if ($imagenes->isEmpty()) {
                return response()->json([
                    'message' => 'No hay imágenes registradas para este sitio.',
                    'data' => [],
                ], 404);
            }
            return response()->json($imagenes);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => 'Error al consultar el sitio: ' . $ex->getMessage()
            ], 500);
        }
    }
    public function selectId($id_img){
        try{
            $imagenes = Imagen::find($id_img);
            if (!$imagenes) {
                return response()->json([
                    'message' => 'La imagen no existe',
                ], 404);
            }
            return response()->json($imagenes);
        }catch(\Exception $ex){
            return response()->json(['error' => 'Error al encontrar la imagen: ' . $ex->getMessage()], 401);
        }
    } 
    public function selectIdSitioImagen($id_img,$id_sitio){
        try{
            $imagenes = Imagen::where('id_img', $id_img)->where('id_sitio', $id_sitio)->first();
            if (!$imagenes) {
            return response()->json([
                'message' => 'No se existe ninguna imagen y sitio con esos ID',
                'data' => null,
            ], 404);
            }
            return response()->json($imagenes);
        }catch(\Exception $ex){
            return response()->json(['error' => 'Error al encontrar la imagen: ' . $ex->getMessage()], 500);
        }
    }
    public function crear(Request $request){
        $validator = Validator::make($request->all(), [
            'id_sitio' => 'required|integer|exists:Sitio,id_sitio',
            'url_img' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        try{
            $imagenes = Imagen::create([
            'id_sitio' => $request->id_sitio,
            'url_img' => $request->url_img,
        ]);
        return response()->json($imagenes, 201);
        }catch (\Exception $ex) {
            return response()->json(['error' => 'Error al añadir imagen: ' . $ex->getMessage()], status: 500);
        }
    }

    public function borrar($id_img){
        try{
           $imagenes = Imagen::find($id_img);
            if (!$imagenes) {
                return response()->json(['error' => 'Imagen no encontrada'], 404);
            }
            $imagenes->delete();
            return response()->json(['message'=>'Imagen Eliminada', 'code'=>'200'], 200);
        }catch(\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }
}
