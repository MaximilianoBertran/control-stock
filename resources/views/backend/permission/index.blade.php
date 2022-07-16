@extends('backend.layouts.app')

@section('title', __('List of :name', ['name' => __('Permissions')]))
@section('page-title', __('List of :name', ['name' => __('Permissions')]))

@section('content')
    @include('backend.permission.shared.filter')
    @include('backend.permission.shared.list')
@endsection