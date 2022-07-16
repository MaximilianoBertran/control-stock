@extends('emails.layouts.master')

@section('content')
    <p>
        @lang('Hello :name', ['name' => $user->fullname]),
    </p>
    <p>
        @lang("If you requested to reset the following user's password"): <br/>
    </p>
    <p>
        {{ $user->username }}
    </p>
    <p>
        @lang("Use the following link to input a new one"):
    </p>
    <a href="{{ $resetUrl }}" target="_blank">
        @lang('Reset Password')
    </a>
    <p>@lang("Once confirmed, you'll be able to log back in").</p>
@endsection
