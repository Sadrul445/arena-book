<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacilityController;
Use App\Http\Controllers\AvailabilityController;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');
Route::post('/facilities/{facility}/availability',[AvailabilityController::class, 'check'])->name('facilities.availability.check');