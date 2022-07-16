@canany(['debug'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-client" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Debug') }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbar-dropdown-client">
            @can('debug')
                <li><a class="dropdown-item" href="{{ route('backend.debug.diagnosis') }}"><i class="fas fa-fw fa-list"></i> @lang('Diagnosis')</a></li>
            @endcan
        </ul>
    </li>
@endcanany
