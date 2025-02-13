<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function () {
    return "Laravel está funcionando correctamente.";
});
