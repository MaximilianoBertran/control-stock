@extends('backend.layouts.app')

@section('title', __('List of :name', ['name' => __('Backend users')]))
@section('page-title', __('List of :name', ['name' => __('Backend users')]))

@section('content')
    @include('backend.admin.shared.filter')
    @include('backend.admin.shared.list')
@endsection