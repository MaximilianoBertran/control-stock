@extends('backend.layouts.form')

@section('title', __('Register'))

@section('form-content')
    {!! Form::open(array('method' => 'POST')) !!}
        @include('backend.profile.shared.form')
    {!! Form::close() !!}
@endsection
