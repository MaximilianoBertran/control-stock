@extends('backend.layouts.app')

@section('title', __('Site administration'))

@section('content')
    <h2>{{ config('app.name') }}</h2>
    <p>{{ __('Site administration') }}</p>
@endsection
