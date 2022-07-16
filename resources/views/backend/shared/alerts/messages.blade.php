<?php 
    $message = isset($message) ? $message : Session::get('message');
    $messages = isset($messages) ? $messages : Session::get('messages');
?>

<div style="position: absolute; top: 0px; right: 0; z-index: 999">
    @if(isset($message))
        @include('backend.shared.alerts.toast', ['title' => "Informaci&oacute;n", 'message' => $message])
    @endif
    @if(isset($messages))
        @foreach($messages as $m)
            @include('backend.shared.alerts.toast', ['title' => "Informaci&oacute;n", 'message' => $message])
        @endforeach
    @endif
</div>
<script>
    if($('.toast').length) {
        $('.toast').toast('show');
    }
</script>
