@extends('backend.layouts.form')

@section('title', __('Edit :name', ['name' => __('Role')]))

@section('form-content')
    {!! Form::model($role, array('route' => array('backend.role.update', $role->id), 'class' => 'form-horizontal')) !!}
        @method('PUT')
        @include('backend.role.shared.form')
    {!! Form::close() !!}
@endsection
