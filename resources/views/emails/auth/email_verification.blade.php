@extends('emails.layouts.master')

@section('content')
    <p>
        @lang('Hello :name', ['name' => $user->fullname]),
    </p>
    <p>
        @lang("You're almost done!")
    </p>
    <p>
        @lang("We need to verify your email address"): 
        <a href="#">
            {{ $user->email }}
        </a>
    </p>
    <a href="{{ $verificationUrl }}" target="_blank">
        @lang("Verify Email")
    </a>
    <p>@lang("Once confirmed, you'll be able to log into the :name platform with your user", ['name' => config('app.name')]).</p>
@endsection
