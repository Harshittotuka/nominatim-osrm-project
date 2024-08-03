<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeocodingController;

Route::post('/get-coordinates', [GeocodingController::class, 'getCoordinates']);
Route::get('/get-suggestions', [GeocodingController::class, 'getSuggestions']);

Route::get('/', function () {
    return view('index');
});