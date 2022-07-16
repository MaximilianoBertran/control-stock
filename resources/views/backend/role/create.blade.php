@extends('backend.layouts.form')

@section('title', __('Add :name', ['name' => __('Role')]))

@section('form-content')
    {!! Form::open(array('route' => 'backend.role.store', 'class' => 'form-horizontal')) !!}
        @include('backend.role.shared.form')
    {!! Form::close() !!}
@endsection
