<?php
use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\CalendarioSalidasController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\SitioCategoriaController;
use App\Http\Controllers\SitioController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\TransporteReservasController;
use App\Http\Controllers\TuristaController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\VisitanteController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {return $request->user();})->middleware('auth:sanctum'); */

// VISITANTES

Route::get('/visitantes', [VisitanteController::class, 'selectAll']);
Route::get('/visitante/{cod}', [VisitanteController::class, 'selectId']);
Route::post('/visitante', [VisitanteController::class, 'crear']);
Route::put('/visitante/{cod}', [VisitanteController::class, 'actualizar']);

    Route::patch('visitante/desactivar{cod_visitante}', [VisitanteController::class, 'desactivar']);
    Route::patch('visitante/activar{cod_visitante}', [VisitanteController::class, 'reactivar']);

// TURISTAS

Route::get('/visitantes/turistas/', [TuristaController::class,'selectAll']);
Route::get('/visitantes/turistas/{mail}', [TuristaController::class,'selectMail']);
Route::get('/visitantes/turistas/cod/{cod_visitante}', [TuristaController::class,'selectCodigo']);
Route::post('/visitantes/turistas/crear', [TuristaController::class,'registrar']);
Route::put('/visitantes/turistas/{cod}', [TuristaController::class,'actualizar']);
Route::delete('/visitantes/turistas/{cod}', [TuristaController::class,'borrar']);

// INSTITUCIONES

Route::get('/visitantes/instituciones', [InstitucionController::class, 'selectAll']); 
Route::get('/visitantes/instituciones/{cod_visitante}', [InstitucionController::class, 'selectId']); 
Route::post('/visitantes/instituciones', [InstitucionController::class, 'crear']); 
Route::put('/visitantes/instituciones/{cod_visitante}', [InstitucionController::class, 'actualizar']); 
Route::delete('/visitantes/instituciones/{cod_visitante}', [InstitucionController::class, 'eliminar']); 

// SITIOS

Route::get('/sitios', [SitioController::class,'selectAll']);
Route::get('/sitios/{id}', [SitioController::class,'selectId']);

Route::post('/sitios/crear', [SitioController::class,'crear']);


Route::post('/sitios', [SitioController::class,'crear']);

Route::put('/sitios/{id}', [SitioController::class,'actualizar']);
Route::delete('/sitios/{id}', [SitioController::class,'eliminar']);

// SITIO_CATEGORIA

Route::get('/sitios/categorias', [SitioCategoriaController::class,'selectAll']);
Route::get('/sitios/categorias{nombre_categoria}', [SitioCategoriaController::class,'selectNombreCategoria']);
Route::post('/sitios/categorias/crear', [SitioCategoriaController::class,'añadir']);
Route::put('/sitios/categorias{nombre_categoria}', [SitioCategoriaController::class,'actualizar']);
Route::delete('/sitios/categorias{nombre_categoria}', [SitioCategoriaController::class,'eliminar']);

// IMAGENES

Route::get('/sitios/imagenes', [ImagenController::class,'selectAll']);
Route::get('/sitios/imagenes/{id_img}', [ImagenController::class,'selectId']);
Route::get('/sitios/imagenes/{id_sitio}', [ImagenController::class,'selectIdSitio']);
Route::get('/sitios/imagenes/{id_img}{id_sitio}', [ImagenController::class,'selectIdSitioImagen']);
Route::post('/sitios/imagenes/añadir', [ImagenController::class,'añadir']);
Route::delete('/sitios/imagenes/{id_img}', [ImagenController::class,'eliminar']);

// UBICACIONES

Route::get('/sitios/ubicaciones', [UbicacionController::class,'selectAll']);
Route::get('/sitios/ubicaciones/{departamento}', [UbicacionController::class,'selectDepartamento']);
Route::post('/sitios/ubicaciones/crear', [UbicacionController::class,'crear']);
Route::put('/sitios/ubicaciones/{id_ubicacion}', [UbicacionController::class,'actualizar']);
Route::delete('/sitios/ubicaciones/{id_ubicacion}', [UbicacionController::class,'eliminar']);
Route::get('/categorias', [SitioCategoriaController::class,'selectAll']);

Route::get('/categorias/{nombre_categoria}', [SitioCategoriaController::class,'selectNombreCategoria']);

Route::post('/categorias', [SitioCategoriaController::class,'añadir']);

Route::put('/categorias/{nombre_categoria}', [SitioCategoriaController::class,'actualizar']);

Route::delete('/categorias/{nombre_categoria}', [SitioCategoriaController::class,'eliminar']);

// IMAGENES

Route::get('/imagenes', [ImagenController::class,'selectAll']);

Route::get('/imagenes/{id_img}', [ImagenController::class,'selectId']);

Route::get('/imagenes/{id_sitio}', [ImagenController::class,'selectIdSitio']);

Route::get('/imagenes/{id_sitio}/{id_img}', [ImagenController::class,'selectIdSitioImagen']);

Route::post('/imagenes/añadir', [ImagenController::class,'añadir']);

Route::delete('/imagenes/{id_img}', [ImagenController::class,'eliminar']);

// UBICACIONES

Route::get('/ubicaciones', [UbicacionController::class,'selectAll']);

Route::get('/ubicaciones/{id}', [UbicacionController::class,'selectId']);

Route::post('/ubicaciones', [UbicacionController::class,'crear']);

Route::put('/ubicaciones/{id_ubicacion}', [UbicacionController::class,'actualizar']);

Route::delete('/ubicaciones/{id_ubicacion}', [UbicacionController::class,'eliminar']);

// RESERVAS

Route::get('/reservas', [ReservaController::class,'selectAll']);
Route::get('/reservas/{id}', [ReservaController::class,'selectId']);
Route::post('/reservas/crear', [ReservaController::class,'crear']);
Route::put('/reservas/{id}', [ReservaController::class,'actualizar']);
Route::delete('/reservas/{id}', [ReservaController::class,'eliminar']);


// NACIONALIDAD

Route::get('/nacionalidades', [NacionalidadController::class,'selectAll']);

//TOUR

Route::get('/tour', [TourController::class,'selectAll']);
Route::get('/tour/{id}', [TourController::class,'selectId']);
Route::post('/tour/crear', [TourController::class,'crear']);
Route::put('/tour/{id}', [TourController::class,'actualizar']);
Route::delete('/tour/{id}', [TourController::class,'eliminar']);

//RUTA

Route::get('/ruta', [RutaController::class,'selectAll']);
Route::get('/ruta/{id_tour}/{id_sitio}', [RutaController::class,'selectId']);
Route::post('/ruta/crear', [RutaController::class,'crear']);
Route::put('/ruta/{id_tour}/{id_sitio}', [RutaController::class,'actualizar']);
Route::delete('/ruta/{id_tour}/{id_sitio}', [RutaController::class,'eliminar']);

Route::get('/ruta/{id_tour}', [RutaController::class,'selectId']);

Route::post('/ruta/crear', [RutaController::class,'crear']);

Route::put('/ruta/{id_tour}', [RutaController::class,'actualizar']);

Route::delete('/ruta/{id_tour}', [RutaController::class,'eliminar']);

//TRANSPORTE

Route::get('/transportes', [TransporteController::class,'selectAll']);
Route::get('/transporte/{id}', [TransporteController::class,'selectId']);
Route::post('/transporte/crear', [TransporteController::class,'crear']);

Route::post('/transporte', [TransporteController::class,'crear']);

Route::put('/transporte/{id}', [TransporteController::class,'actualizar']);
Route::delete('/transporte/{id}', [TransporteController::class,'eliminar']);

//Alojamiento

Route::get('/alojamientos', [AlojamientoController::class, 'selectAll']);
Route::get('/alojamientos/{id}', [AlojamientoController::class, 'selectId']);
Route::post('/alojamientos', [AlojamientoController::class, 'crear']);
Route::put('/alojamientos/{id}', [AlojamientoController::class, 'actualizar']);

Route::put('/alojamientos/desactivar/{id}', [AlojamientoController::class, 'desactivar']);


//Habitacion

Route::get('/habitaciones', [HabitacionController::class, 'selectAll']);
Route::get('/habitaciones/{id}', [HabitacionController::class, 'SelectId']);
Route::post('/habitaciones', [HabitacionController::class, 'crear']);
Route::put('/habitaciones/actualizar', [HabitacionController::class, 'actualizaHabitacion']);

Route::delete('/habitaciones/{id}', [HabitacionController::class, 'eliminar']);
// Nuevo  para registrar alojamiento con habitaciones
Route::post('/alojamiento-con-habitaciones', [AlojamientoController::class, 'crearConHabitaciones']);
Route::get('/habitaciones/alojamiento/{id_alojamiento}', [HabitacionController::class, 'habitacionesParaDataGrid']);

// calendario salidas

Route::get('/calendario', [CalendarioSalidasController::class, 'selectAll']); 
Route::get('/calendario/{id_salida}', [CalendarioSalidasController::class, 'selectId']); 
Route::post('/calendario', [CalendarioSalidasController::class, 'crear']); 
Route::put('/calendario/{id_salida}', [CalendarioSalidasController::class, 'actualizar']); 
Route::delete('/calendario/{id_salida}', [CalendarioSalidasController::class, 'eliminar']); 

