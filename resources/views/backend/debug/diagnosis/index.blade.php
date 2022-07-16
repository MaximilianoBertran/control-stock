@extends('backend.layouts.app')

@section('title', __('Diagnosis'))

@section('content')
    <div class="container">
        <h3 class="mb-4">@lang('Diagnosis')</h3>
        <div class="row justify-content-center">
            <div class="col-md-6 pb-3">
                @include("backend.debug.diagnosis.shared.logs")
            </div>
        </div>
    </div>
    
    <script>
    $(document).on('submit', 'form.form-ajax', function(e) {
        $form = $(this);
        e.preventDefault();

        let method = ($(this).prop('method')).toLowerCase();
        let data = $(this).serializeArray().reduce(function(a, x) { a[x.name] = x.value; return a; }, {});

        axios({
            method: method,
            url: $(this).prop('action'),
            params: (method === 'get') ? data : null,
            data: (method === 'post') ? data : null
        }).then(function (response) {
            $form.find('.response')
                .removeClass('text-danger')
                .html(JSON.stringify(response.data, null, 4))
            ;
        }).catch(function (error) {
            $form.find('.response')
                .addClass('text-danger')
                .html(JSON.stringify(error.response.data, null, 4))
            ;
        });

    });
    </script>
@endsection
