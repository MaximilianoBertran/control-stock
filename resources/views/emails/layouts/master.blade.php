<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>{{ config('app.title') }}</title>
    </head>
    <body>
        <header>
            @include('emails.layouts.shared.header')
        </header>
        <section>
            @yield('content')
            <p>@lang("If you have any issues, reply to this message to contact our help desk").</p>
        </section>

        <footer>
            @include('emails.layouts.shared.footer')
        </footer>
    </body>
</html>