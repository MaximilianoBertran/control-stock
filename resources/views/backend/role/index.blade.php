@extends('backend.layouts.app')

@section('title', __('List of :name', ['name' => __('Roles')]))
@section('page-title', __('List of :name', ['name' => __('Roles')]))

@section('content')
    @include('backend.role.shared.filter')
    @include('backend.role.shared.list')
@endsection