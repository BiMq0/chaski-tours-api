<?php
use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\CalendarioSalidasController;
use App\Http\Controllers\CarritoReservasController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\SitioCategoriaController;
use App\Http\Controllers\SitioController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\TipoHabitacionController;
use App\Http\Controllers\TipoVisitanteController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\TransporteReservasController;
use App\Http\Controllers\TuristaController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\VisitanteController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {return $request->user();})->middleware('auth:sanctum');


// TURISTAS

Route::get('/visitantes/turistas/', [TuristaController::class,'selectAll']);

Route::get('/visitantes/turistas/{mail}', [TuristaController::class,'selectMail']);

Route::post('/visitantes/turistas/', [TuristaController::class,'insert']);

Route::put('/visitantes/turistas/{mail}', [TuristaController::class,'update']);

Route::delete('/visitantes/turistas/{mail}', [TuristaController::class,'delete']);



// NACIONALIDAD
Route::get('/nacionalidades/', [NacionalidadController::class,'selectAll']);