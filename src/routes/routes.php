<?php

use Illuminate\Support\Facades\Route;
use Duoneos\Larablend\Http\Controllers\LarablendRouteController;

Auth::routes();
Route::middleware(['web'])->group(function(){
    Route::any('/{model}/{action?}/{id?}/{extra?}', [LarablendRouteController::class, 'router']);
});

