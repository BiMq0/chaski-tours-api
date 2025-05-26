<?php

use App\Http\Controllers\TuristaController;
use App\Http\Controllers\VisitorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {return $request->user();})->middleware('auth:sanctum');

Route::get('/visitantes/turistas/', [TuristaController::class,'selectAll']);

Route::get('/visitantes/turistas/{mail}', [TuristaController::class,'selectId']);