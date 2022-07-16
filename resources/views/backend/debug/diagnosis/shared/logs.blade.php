<div class="card h-100" id="card-logs">
    <div class="card-header text-capitalize">@lang('Logs')</div>
    <div class="card-body">
        <ul class="list-unstyled">
            @foreach($logs as $log)
                <li>
                    <a href="{{ route('backend.debug.diagnosis.log', ['log' => $log->getRelativePathName()]) }}">
                        {{ $log->getRelativePathName() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
