<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeolocationLogController;

// Route for loading Home page for entering IP Address
Route::get('/', [GeolocationLogController::class, 'index'])->name('index');
// Route for storing the geographic location information
Route::post('/storeGeoLocationInfo', [GeolocationLogController::class, 'storeGeoLocation'])->name('storeGeoLocationInfo');
// Route for displaying all geographic locations
Route::get('/allGeographicLocations', [GeolocationLogController::class, 'allGeographicLocations'])->name('allGeographicLocations');
