@extends('backend.layouts.app')

@section('title', 'Productos')

@section('page-title', 'Control Stock - Productos' )

@section('content')
    @include('backend.stock.shared.filter') 
    @include('backend.stock.shared.list') 
@endsection