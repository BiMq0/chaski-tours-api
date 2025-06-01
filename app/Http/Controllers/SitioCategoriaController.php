<?php

namespace App\Http\Controllers;

use App\Models\Sitio_Categoria;
use Illuminate\Http\Request;

class SitioCategoriaController extends Controller
{
    public function selectAll(){
        $categoria = Sitio_Categoria::all();
        return response()->json($categoria);
    }
    public function selectNombreCategoria($nombre_categoria){
        try{
            $categoria = Sitio_Categoria::where('nombre_categoria',$nombre_categoria)->get();
            return response()->json($categoria);
        }catch(\Exception $ex){
            return response()->json(['error' => 'Error al consultar la categoría: ' . $ex->getMessage()], 404);
        }
    }
    public function añadir(Request $request){
        try{
            $categoria = Sitio_Categoria::create([
            'nombre_categoria'=>$request->nombre_categoria,
            'id_sitio' => $request->id_sitio
        ]);

        return response()->json($categoria, 201);
        }catch (\Exception $ex) {
            return response()->json(['error' => 'Error al añadir la categoría: ' . $ex->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $nombre_categoria){
        try{
            $categoria = Sitio_Categoria::find($nombre_categoria);
            $request->nombre_categoria ? $categoria->nombre_categoria = $request->nombre_categoria : null;
            $request->id_sitio ? $categoria->id_sitio = $request->id_sitio : null;
            $categoria->save();
            return response()->json($categoria, 200);
        }catch (\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }

    public function eliminar($nombre_categoria){
        try{
            $sitio = Sitio_Categoria::where('nombre_categoria',$nombre_categoria);
            $sitio->delete();
            return response()->json(['message'=>'Categoría eliminada', 'code'=>'200'], 200);
        }catch(\Exception $ex){
            return response()->json(data: $ex->getMessage());
        }
    }
}
