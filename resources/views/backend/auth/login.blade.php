@extends('backend.layouts.form', ['colsize' => 'col-md-10 col-lg-8'])

@section('title', __('Login'))

@section('form-content')
    @if(config('captcha.sitekey'))
        {!! NoCaptcha::renderJs('es', false, 'validateCaptcha') !!}
    @endif

    <form id="login-form" method="POST" action="{{ route('backend.login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

            <div class="col-md-6">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        @if(config('captcha.sitekey'))
            <div class="form-group row position-relative">
                <label for="g-recaptcha-response" class="col-md-4 col-form-label text-md-right"></label>

                <div class="col-md-6">
                    <div class="@error('g-recaptcha-response') is-invalid @enderror">
                        {!! NoCaptcha::display() !!}
                    </div>

                    @error('g-recaptcha-response')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endif

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-outline-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('backend.password.request'))
                    <a class="btn btn-link" href="{{ route('backend.password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
@endsection
