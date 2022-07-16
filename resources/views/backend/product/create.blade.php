@extends('backend.layouts.form')

@section('title', __('Add :name', ['name' => 'Producto']))

@section('form-content')
    {!! Form::open(array('route' => 'backend.product.store', 'class' => 'form-horizontal', 'id' => 'formProduct', 'files' => true)) !!}
        @include('backend.product.shared.form')
    {!! Form::close() !!}
@endsection
