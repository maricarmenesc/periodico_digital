<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;

// Rutas para Noticias
Route::get('/noticias', [NoticiaController::class, 'index']);
Route::get('/noticias/{id}', [NoticiaController::class, 'show']);
Route::post('/noticias', [NoticiaController::class, 'store']);
Route::put('/noticias/{id}', [NoticiaController::class, 'update']);
Route::delete('/noticias/{id}', [NoticiaController::class, 'destroy']);