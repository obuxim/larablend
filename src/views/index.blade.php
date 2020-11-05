
@extends('larablend::layouts.app')
@section('content')
    @section('title', 'All '.ucwords(str_replace('_', ' ', $data->table)))
    <h2>All {{ ucwords(str_replace('_', ' ', $data->table)) }}</h2>
    @include('larablend::components.flash')
    <div>
        <a href="/{{$data->route}}/create" class="btn btn-secondary">Add New<i class="ml-2 nc-icon nc-simple-add"></i></a>
    </div>
    <div class="row">
        <div class="col-12 card shadow py-3">
            @include('larablend::components.datatable', ['data' => $data])
        </div>
    </div>
@endsection
@section('custom-inline-script')

$('.datatable').DataTable();

@endsection
