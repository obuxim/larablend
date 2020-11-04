<?php

namespace Duoneos\Larablend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LarablendRouteController extends Controller {

    public static function router($model, $action = 'index', $id = null, $extra = null, Request $request){
        $api = false;
        if($model == 'api'){
            $api = true;
            $model = $action;
            $action = ($id == null) ? 'index' : $id;
            $id = $extra;
        }
        $model_name = Str::ucfirst(Str::camel($model));
        $model_path = LarablendRouteController::get_model_path_from_model($model_name);
        if(!class_exists($model_path)){
            abort(404);
        }
        $controller_path = LarablendRouteController::get_controller_by_model_name($model_name);
        switch ($action){
            case "index":
                return app()->call($controller_path.'::index', ['model' => $model_path, 'api' => $api]);
                break;
            case "show":
                return app()->call($controller_path.'::show', ['model' => $model_path, 'api' => $api, 'id' => $id]);
                break;
            case "create":
                return app()->call($controller_path.'::create', ['model' => $model_path, 'api' => $api]);
                break;
            case "store":
                return app()->call($controller_path.'::store', ['model' => $model_path, 'api' => $api, 'request' => $request]);
                break;
            case "edit":
                return app()->call($controller_path.'::edit', ['model' => $model_path, 'api' => $api, 'id' => $id]);
                break;
            case "update":
                return app()->call($controller_path.'::update', ['model' => $model_path, 'api' => $api, 'id' => $id, 'request' => $request]);
                break;
            case "delete":
                return app()->call($controller_path.'::destroy', ['model' => $model_path, 'api' => $api, 'id' => $id]);
                break;
            case "search":
                return app()->call($controller_path.'::search', ['model' => $model_path, 'request' => $request]);
                break;
            default:
                return app()->call($controller_path.'::'.$action, ['model' => $model_path, 'request' => $request, 'api' => $api]);
                break;
        }
    }

    public static function get_model_path_from_model($model){
        $laravel_model_path = "App\\Models\\".$model;
        $larablend_model_path = "Duoneos\\Larablend\\Models\\".$model;
        if(class_exists($laravel_model_path)){
            return $laravel_model_path;
        }else if(class_exists($larablend_model_path)){
            return $larablend_model_path;
        }else{
            null;
        }
    }

    public static function get_controller_by_model_name($model)
    {
        $controller_name_plural = Str::plural($model) . "Controller";
        $controller_name_singular = $model . "Controller";
        $laravel_controller_path_plural = "App\\Http\\Controllers\\".$controller_name_plural;
        $laravel_controller_path_singular = "App\\Http\\Controllers\\".$controller_name_singular;
        $larablend_controller_path_plural = "Duoneos\\Larablend\\Http\\Controllers\\".$controller_name_plural;
        $larablend_controller_path_singular = "Duoneos\\Larablend\\Http\\Controllers\\".$controller_name_singular;
        if(class_exists($laravel_controller_path_plural)){
            return $laravel_controller_path_plural;
        }else if(class_exists($larablend_controller_path_plural)){
            return $larablend_controller_path_plural;
        }else if(class_exists($laravel_controller_path_singular)){
            return $laravel_controller_path_singular;
        }else if(class_exists($larablend_controller_path_singular)){
            return $larablend_controller_path_singular;
        }else {
            return "Duoneos\\Larablend\\Http\\Controllers\\LarablendCrudController";
        }
    }
}
