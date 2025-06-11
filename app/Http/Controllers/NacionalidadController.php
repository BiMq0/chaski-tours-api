<?php

namespace App\Http\Controllers;

use App\Models\Nacionalidad;
use Illuminate\Http\Request;

class NacionalidadController extends Controller
{
    public function selectAll()
    {
        try {
            $nacionalidades = Nacionalidad::all();
            return response()->json([
                'data' => $nacionalidades], 
                200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()],
             500);
        }
    }
}
