
@extends('larablend::layouts.app')
@section('content')
    <h2>All {{ ucwords(str_replace('_', ' ', $data->table)) }}</h2>
    <div>
        <a href="/{{$data->route}}" class="btn btn-secondary">List All<i class="ml-2 nc-icon nc-bullet-list-67"></i></a>
    </div>
    <div class="row p-3 card shadow">
        @include('larablend::components.form', ['data' => $data])
    </div>
@endsection
