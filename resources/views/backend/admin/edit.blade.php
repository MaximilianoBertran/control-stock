@extends('backend.layouts.form')

@section('title', __('Edit :name', ['name' => __('Backend user')]))

@section('form-content')
    {!! Form::model($admin, array('route' => array('backend.admin.update', $admin->id), 'class' => 'form-horizontal')) !!}
        @method('PUT')
        @include('backend.admin.shared.form')
    {!! Form::close() !!}
@endsection
