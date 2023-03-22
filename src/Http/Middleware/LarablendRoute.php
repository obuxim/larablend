<?php

namespace Duoneos\Larablend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class LarablendRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $path = request()->path();
        $exploded = explode('/', $path);
        if($exploded[0] == "api"){
            $api = true;
            $model = $exploded[1];
            $action = array_key_exists(2, $exploded) ? $exploded[2] : 'index';
            $id = array_key_exists(3, $exploded) ? $exploded[3] : null;
        }else{
            $api = false;
            $model = $exploded[0];
            $action = array_key_exists(1, $exploded) ? $exploded[1] : 'index';
            $id = array_key_exists(2, $exploded) ? $exploded[2] : null;
        }
        $model_name = Str::ucfirst(Str::camel($model));
        if($model_name == 'ViewSetting'){
            $model_path = "\Duoneos\\Larablend\\Models\\".$model_name;
        }else{
            $model_path = "\App\\Models\\".$model_name;
        }
        $controller_path = "\Duoneos\\Larablend\\Http\\Controllers\\LarablendController";
        if(class_exists($model_path)){
            $custom_controller = "\App\\Http\\Controllers\\".$model_name."Controller";
            if(class_exists($custom_controller)){
                return app()->call($custom_controller."::".$action, [
                    'request' => $request,
                    'model' => $model,
                    'action' => $action,
                    'id' => $id,
                    'api' => $api,
                    'model_path' => $model_path,
                ]);
            }
            $custom_controller = "\App\\Http\\Controllers\\".Str::plural($model_name)."Controller";
            if(class_exists($custom_controller)){
                return app()->call($custom_controller."::".$action, [
                    'request' => $request,
                    'model' => $model,
                    'action' => $action,
                    'id' => $id,
                    'api' => $api,
                    'model_path' => $model_path,
                ]);
            }
            return app()->call($controller_path."::".$action, [
                'request' => $request,
                'model' => $model,
                'action' => $action,
                'id' => $id,
                'api' => $api,
                'controller_path' => $controller_path,
                'model_path' => $model_path,
            ]);
        }else{
            return $next($request, $next);
        }
    }
}
