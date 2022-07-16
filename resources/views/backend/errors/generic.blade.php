@extends('backend.layouts.app') 

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="error-code unselectable" unselectable="on">@yield('code', $exception->getStatusCode())</h1>
            <p class="error-message">@yield('message', __("The page you're looking for is not available"))</p>
            <div class="btn-block">
                <a href="{{ route('backend.home') }}" class="btn btn-outline-dark btn-lg" role="button">@lang('Back to Home')</a>
            </div>
        </div>
    </div>
@endsection