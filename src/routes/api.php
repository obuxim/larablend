<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Duoneos\Larablend\Http\Middleware\LarablendRoute;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('api')->group(function(){
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::middleware(LarablendRoute::class)->any('/{model}/{action?}/{id?}',function($model, $action = 'index', $id = null){
        return response()->json([
            $model,$action,$id
        ]);
    });
});