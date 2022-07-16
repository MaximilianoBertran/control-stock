@extends('backend.layouts.form')

@section('title', __('Add :name', ['name' => __('Backend user')]))

@section('form-content')
    {!! Form::open(array('route' => 'backend.admin.store', 'class' => 'form-horizontal')) !!}
        @include('backend.admin.shared.form')
    {!! Form::close() !!}
@endsection
