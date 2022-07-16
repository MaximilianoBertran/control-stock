@canany(['view-users', 'create-users'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('Users')
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbar-dropdown-user">
            @can('view-users')
                <li><a class="dropdown-item" href="{{ route('backend.user.index') }}"><i class="fas fa-fw fa-list"></i> @lang('List')</a></li>
            @endcan
            @can('view-users')
                <li><a class="dropdown-item" href="{{ route('backend.user.create') }}"><i class="fas fa-fw fa-plus"></i> @lang('Add')</a></li>
            @endcan
        </ul>
    </li>
@endcanany
