<?php

use Duoneos\Larablend\Http\Middleware\LarablendRoute;

Route::middleware(LarablendRoute::class)->any("/{model}/{action?}/{id?}", function (){
    return "404";
});
