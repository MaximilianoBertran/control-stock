@extends('backend.layouts.form')

@section('title', __('My Profile'))

@section('form-content')
    {!! Form::model($admin, array('route' => 'backend.profile.update', 'method' => 'POST')) !!}
        @method('PUT')
        @include('backend.profile.shared.form')
    {!! Form::close() !!}
@endsection
