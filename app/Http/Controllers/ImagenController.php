<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function selectAll(){
        $imagenes = Imagen::all();
        return response()->json($imagenes);
    }
    public function selectID($id_img){
        try{
            $imagenes = Imagen::where('id_img', $id_img)->get();
            return response()->json($imagenes);
        }catch(\Exception $ex){
            return response()->json(['error' => 'Error al encontrar imagen: ' . $ex->getMessage()], 401);
        }
    }
    public function añadir(Request $request){
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
            $imagenes->delete();
            return response()->json(['message'=>'Imagen Eliminada', 'code'=>'200'], 200);
        }catch(\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }
}
