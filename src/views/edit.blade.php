@extends('larablend::layouts.default')
@section('page_title', 'Create '.Str::ucfirst($model))
@section('content')
    <!-- Space for Errors -->
    @include('larablend::component.form', ['data' => $data])
@endsection
