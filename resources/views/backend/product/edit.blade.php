@extends('backend.layouts.form')

@section('title', __('Edit :name', ['name' => $product->name]))

@section('form-content')
    {!! Form::model($product, array('route' => array('backend.product.update', $product->id), 'class' => 'form-horizontal', 'id' => 'formProduct', 'files' => true)) !!}
        @method('PUT')
        @include('backend.product.shared.form')
    {!! Form::close() !!}
@endsection