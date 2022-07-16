@extends('backend.layouts.app')

@section('title', 'Productos')

@section('page-title', 'Control Stock - Productos' )

@section('content')
    @include('backend.product.shared.filter') 
    @include('backend.product.shared.list') 
@endsection