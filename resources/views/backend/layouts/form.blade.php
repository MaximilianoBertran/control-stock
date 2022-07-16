@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="{{ isset($colsize) ? $colsize : 'col-md-12' }}">
                <div class="card">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        @yield('form-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
