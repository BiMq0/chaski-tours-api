<?php
use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\CalendarioSalidasController;
use App\Http\Controllers\CarritocarritosController;
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

Route::get('/user', function (Request $request) {return $request->user();})->middleware('auth:sanctum');

// VISITANTES

// TURISTAS

Route::get('/visitantes/turistas/', [TuristaController::class,'selectAll']);

Route::get('/visitantes/turistas/{mail}', [TuristaController::class,'selectMail']);

Route::post('/visitantes/turistas/crear', [TuristaController::class,'registrar']);

Route::put('/visitantes/turistas/{cod}', [TuristaController::class,'actualizar']);

Route::delete('/visitantes/turistas/{cod}', [TuristaController::class,'borrar']);

// INSTITUCIONES

// SITIOS

Route::get('/sitios', [SitioController::class,'selectAll']);

Route::get('/sitios/{id}', [SitioController::class,'selectId']);

Route::post('/sitios/crear', [SitioController::class,'crear']);

Route::put('/sitios/{id}', [SitioController::class,'actualizar']);

Route::delete('/sitios/{id}', [SitioController::class,'eliminar']);

// RESERVAS

Route::get('/reservas', [ReservaController::class,'selectAll']);

Route::get('/reservas/{id}', [ReservaController::class,'selectId']);

Route::post('/reservas/crear', [ReservaController::class,'crear']);

Route::put('/reservas/{id}', [ReservaController::class,'actualizar']);

Route::delete('/reservas/{id}', [ReservaController::class,'eliminar']);

// CARRITO RESERVAS

Route::get('/carrito', [CarritoReservasController::class,'selectAll']);

Route::get('/carrito/{id}', [CarritoReservasController::class,'selectId']);

Route::post('/carrito/crear', [CarritoReservasController::class,'crear']);

Route::put('/carrito/{id}', [CarritoReservasController::class,'actualizar']);

Route::delete('/carrito/{id}', [CarritoReservasController::class,'eliminar']);

// RESERVAS_TRANSPORTES

// NACIONALIDAD

Route::get('/nacionalidades', [NacionalidadController::class,'selectAll']);