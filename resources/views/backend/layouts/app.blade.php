<!DOCTYPE html>
<!--[if lt IE 7]><html lang="es" class="lt-ie10 lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="es" class="lt-ie10 lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="es" class="lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html lang="es" class="lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="{{ app()->getLocale() }}">
<!--<![endif]-->
<head>
    @hasSection('title')
        <title>{{ config('app.title') }} - @yield('title')</title>
    @else
        <title>{{ config('app.title') }}</title>
    @endif
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="author" content="{{ config('app.author') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('backend/css/app.css') }}">
    <script src="{{ mix('backend/js/app.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('FileSaver/FileSaver.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    @include('backend.layouts.shared.navbar')

    <section>
        <div class="container pt-4">
            <div class="position-relative">
                @include('backend.shared.alerts.messages')
                @include('backend/alerts/errors')
            </div>
            <h3 class="mb-4">@yield('page-title')</h3>
            @yield('content')
        </div>
    </section>

    <script>

        // {{-- Confirmacion antes de eliminar --}}
        $(document).on('click', '.btn-delete', function (event) {
            event.preventDefault();
            let warning = "@lang(':name will be :verb', ['verb' => __('deleted')])".replace(':name', $(this).data('name'));
            if (confirm(warning)) {
                $($(this).data('target')).submit();
            }
        });

        $(document).ready(function() {
            
            // {{-- Confirmacion de contraseña por HTML5 --}}
            $('#password, #password_confirmation').change(function() {
                if ($(this).closest('form').find('#password_confirmation').length === 0) {
                    return;
                }

                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();

                if (password !== password_confirmation) {
                    $('#password')[0].setCustomValidity("@lang('validation.confirmed', ['attribute' => __('validation.attributes.password')])");
                } else {
                    $('#password')[0].setCustomValidity('');
                }
            });
            function initializePage(){
                if($("#editando").length){
                    $("#imageFilePage").removeAttr('required');
                }
            }

        });
    </script>

    @yield('after-scripts')
    @show
</body>
</html>