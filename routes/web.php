<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/booking', 'App\Http\Controllers\Controller@booking');
Route::get('/rooms', 'App\Http\Controllers\Controller@rooms');
Route::post('/success', 'App\Http\Controllers\Controller@acceptReservation');
