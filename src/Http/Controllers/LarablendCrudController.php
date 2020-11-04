<?php

namespace Duoneos\Larablend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class LarablendCrudController extends Controller {

    public static function index($model, $api){
        $all = $model::all();
//        $count = count($all);
//        $take = (int) ($count*25)/100;
        $data = $all;
        $response = LarablendCrudController::generate_response($model);
        $response->data = $data;
        $response->entry_keys = LarablendCrudController::model_to_entry_keys($model);
        if($api){
            return response()->json($response);
        }else{
            $custom_view = LarablendCrudController::model_path_to_route_name($model).".index";
            if(view()->exists($custom_view)){
                return view($custom_view, ['data' => $response]);
            }else{
                return view('larablend::index', ['data' => $response]);
            }
        }
    }

    public static function show($model, $id, $api){
        $entry = $model::findOrFail($id);
        $response = LarablendCrudController::generate_response($model);
        if ($api){
            return response()->json($response);
        }else{
            $custom_view = LarablendCrudController::model_path_to_route_name($model).".show";
            if(view()->exists($custom_view)){
                return view($custom_view, ['data' => $response]);
            }else{
                return view('larablend::show', ['data' => $response]);
            }
        }
    }

    public static function create($model, $api){
        $table_name = LarablendCrudController::model_path_to_table_name($model);
        $response = LarablendCrudController::generate_response($model);
        $response->action = '/'.LarablendCrudController::model_path_to_route_name($model).'/store';
        $inputs = LarablendCrudController::table_to_inputs($table_name);
        $response->inputs = $inputs;
        $custom_view = LarablendCrudController::model_path_to_route_name($model).'.create';
        if(view()->exists($custom_view)){
            return view($custom_view, ['data' => $response]);
        }else{
            return view('larablend::create', ['data' => $response]);
        }
    }

    public static function store($model, Request $request, $api){
        $inputs = $request->except('_token');
//        dd($inputs);
        $entry = LarablendCrudController::inputs_model_to_entry($inputs, $model);
        try {
            $entry->save();
            Session::flash('message', 'Successfully saved!');
            Session::flash('alert-class', 'alert-success');
            if($api){
                $response = self::generate_response($model);
                $response->data = $entry;
                return response()->json($response);
            }
            return redirect("/".LarablendCrudController::model_path_to_route_name($model));
        }catch (\Exception $e){
            Session::flash('message', 'Could not save! Error: '.$e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            if($api){
                $response = self::generate_response($model, true);
                $response->data = $e->getMessage();
                return response()->json($response);
            }
            return redirect("/".LarablendCrudController::model_path_to_route_name($model));
        }
    }

    public static function edit($model, $id, $api){
        $entry = $model::findOrFail($id);
        $table_name = LarablendCrudController::model_path_to_table_name($model);
        $response = LarablendCrudController::generate_response($model);
        $response->action = '/'.LarablendCrudController::model_path_to_route_name($model).'/update/'.$id;
        $inputs = LarablendCrudController::table_to_inputs($table_name, $entry);
        $response->inputs = $inputs;
        $custom_view = LarablendCrudController::model_path_to_route_name($model).'.create';
        if(view()->exists($custom_view)){
            return view($custom_view, ['data' => $response]);
        }else{
            return view('larablend::create', ['data' => $response]);
        }
    }

    public static function update($model, $id, Request $request, $api){
        $inputs = $request->except('_token');
        $oldEntry = $model::findOrFail($id);
        $entry = LarablendCrudController::inputs_model_to_entry($inputs, $model, $oldEntry);
        try {
            $entry->save();
            Session::flash('message', 'Successfully saved!');
            Session::flash('alert-class', 'alert-success');
            if($api){
                $response = self::generate_response($model);
                $response->data = $entry;
                return response()->json($response);
            }
            return redirect("/".LarablendCrudController::model_path_to_route_name($model));
        }catch (\Exception $e){
            Session::flash('message', 'Could not save! Error: '.$e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            if($api){
                $response = self::generate_response($model);
                $response->data = $e->getMessage();
                return response()->json($response);
            }
            return redirect("/".LarablendCrudController::model_path_to_route_name($model));
        }
    }

    public static function destroy($model, $id, $api){
        $entry = $model::findOrFail($id);
        try {
            $entry->delete();
            Session::flash('message', 'Successfully deleted!');
            Session::flash('alert-class', 'alert-success');
            $response = self::generate_response($model);
            $response->data = $entry;
            if($api){
                return response()->json($response);
            }
            return redirect('/'.self::model_path_to_route_name($model));
        }catch (\Exception $e){
            Session::flash('message', 'Could not delete: '.$e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            $response = self::generate_response($model, true);
            $response->data = $e->getMessage();
            if($api){
                return response()->json($response);
            }
            return redirect('/'.self::model_path_to_route_name($model));
        }
    }

    // Search
    public static function search(Request $request, $model){
        $queries = $request->except('extended');
        $finalQueries = [];
        $results = [];
        foreach ($queries as $key => $value){
            $finalQuery = [];
            if(Str::contains($key, 'min_')){
                $key = substr($key, 4);
                array_push($finalQuery, $key, '>=', $value);
            }else if(Str::contains($key, 'max_')){
                array_push($finalQuery, $key, '<=', $value);
            }else{
                array_push($finalQuery, $key, 'like', '%'.$value.'%');
            }
            array_push($finalQueries, $finalQuery);
        }
        if($request->extended == true){
            $results = $model::where('id', '>', 0)->orWhere($finalQueries)->get();
        }else{
            $results = $model::where($finalQueries)->get();
        }
        $response = new \stdClass();
        $response->error = false;
        $response->model = $model;
        $response->route = LarablendCrudController::model_path_to_route_name($model);
        $response->data = $results;
        return response()->json($response);
    }

    // Helpers
    public static function model_path_to_table_name($model_path){
        $params = explode("\\", $model_path);
        $model_name = $params[count($params)-1];
        return Str::plural(Str::snake($model_name));
    }

    public static function model_path_to_model_name($model_path){
        $params = explode("\\", $model_path);
        return $params[count($params)-1];
    }

    public static function model_path_to_route_name($model_path){
        $model_name =  LarablendCrudController::model_path_to_model_name($model_path);
        return strtolower(Str::snake($model_name));
    }

    public static function column_name_to_label($column_name){
        if(Str::contains($column_name, '_id')){
            return Str::singular(ucwords(str_replace('_', ' ', substr($column_name, '0', strlen($column_name)-3)))).'/s';
        }else{
            return Str::singular(ucwords(str_replace('_', ' ', $column_name)));
        }
    }

    public static function column_to_input($column, $value = ''){
        $dataType = $column->getType()->getName();
        $column_name = $column->getName();
        $label = LarablendCrudController::column_name_to_label($column_name);
        $placeholder = "Please enter ".$label." here!";
        $type = $dataType;
        switch($dataType){
            case "integer":
                $type = "number";
                break;
            case "string":
                $type = "text";
                break;
            case "boolean":
                $type = "checkbox";
                break;
            case "datetime":
                $type = "datetime";
                break;
            case "text":
                $type = "textarea";
                break;
            default:
                break;
        }
        if(Str::contains($column_name, 'email')){
            $type = 'email';
        }else if(Str::contains($column_name, 'password')){
            $type = 'password';
        } else if(Str::contains($column_name, '_time')){
            $type = 'time';
        }
        else if(Str::contains($column_name, '_date'))
        {
            $type = 'date';
        }
        else if(Str::contains($column_name, '_datetime'))
        {
            $type = 'datetime';
        }
        else{
            //
        }
        $input = new \stdClass();
        $input->type = $type;
        $input->id = $column_name;
        $input->name = $column_name;
        $input->label = $label;
        $input->value = $value;
        $input->placeholder = $placeholder;
        return $input;
    }

    public static function table_to_inputs($table, $entry = null){
        $inputs = [];
        $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns($table);
        //Column to Input
        foreach ($columns as $column){
            $column_name = $column->getName();
            if(str_contains($column_name, '_at')){
                continue;
            }
            else if($column_name == 'id' ){
                continue;
            }
            else if(Str::contains($column_name, '_id')){
                $relation_table_name = Str::plural(substr($column_name, 0, strlen($column_name)-3));
                $model_name = Str::ucfirst(Str::singular(Str::camel($relation_table_name)));
                $model_path = "App\\Models\\".$model_name;
                $all = $model_path::all();
                $input = new \stdClass();
                $input->type = 'select';
                $input->all = $all;
                $input->id = $column_name;
                $input->name = $column_name;
                $input->value = ($entry != null) ? $entry->$column_name : '';
                $input->label = LarablendCrudController::column_name_to_label($column_name);
                $input->placeholder = "Please enter ".$input->label." here!";
                $input->form = new \stdClass();
                $input->form->action = "/api/".Str::singular($relation_table_name).'/store';
                $input->form->inputs = LarablendCrudController::table_to_inputs($relation_table_name);
                array_push($inputs, $input);
            }else{
                $value = ($entry != null) ? $entry->$column_name : '';
                $input = LarablendCrudController::column_to_input($column, $value);
                array_push($inputs, $input);
            }
        }
        return $inputs;
    }

    public static function inputs_model_to_entry($inputs, $model, $entry = null){
        if($entry == null){
            $entry = new $model();
        }
        foreach ($inputs as $key => $value){
            $entry->$key = $value;
        }
//        dd($entry);
        return $entry;
    }

    public static function model_to_entry_keys($model){
        $table_name = LarablendCrudController::model_path_to_table_name($model);
        $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns($table_name);
        $entry_keys = [];
        foreach ($columns as $column){
            $column_name = $column->getName();
            if($column_name == 'id' || Str::contains($column_name, '_at') || Str::contains($column_name, 'password') || Str::contains($column_name, '_token')){
                continue;
            }
            else if(Str::contains($column_name, '_id'))
            {
                $entry_key = substr($column_name, 0, strlen($column_name)-3);
                array_push($entry_keys, $entry_key);
            }
            else{
                array_push($entry_keys, $column_name);
            }
        }
        return $entry_keys;
    }

    public static function generate_response($model, $error = false, $action = true){
        $data = new \stdClass();
        $data->error = $error;
        $data->model = $model;
        $data->action = $action;
        $data->route = LarablendCrudController::model_path_to_route_name($model);
        $data->table = LarablendCrudController::model_path_to_table_name($model);
        return $data;
    }
}
