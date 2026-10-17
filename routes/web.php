<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacilityController;
Use App\Http\Controllers\AvailabilityController;
use App\Models\Facility;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/facilities', function () {
    $facilities = Facility::with([
        'category',
        'pricingPeriods.pricingRules',
    ])
        ->orderBy('sort_order')
        ->get();

    return view('facilities.index', compact('facilities'));
})->name('facilities.index');
Route::post('/facilities/{facility}/availability',[AvailabilityController::class, 'check'])->name('facilities.availability.check');