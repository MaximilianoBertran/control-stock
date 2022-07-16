@canany(['debug', 'view-admins', 'create-admins', 'view-roles', 'create-roles', 'view-permissions'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-security" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('Security')
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSecurity">
            @canany(['debug'])
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-fw fa-bug"></i> @lang('Debug')</a>
                    <ul class="dropdown-menu" aria-labelledby="navbar-dropdown-client">
                        @can('debug')
                            <li><a class="dropdown-item" href="{{ route('backend.debug.diagnosis.index') }}"><i class="fas fa-fw fa-stethoscope"></i> @lang('Diagnosis')</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['view-admins', 'create-admins'])
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-fw fa-user"></i> @lang('Backend users')</a>
                    <ul class="dropdown-menu">
                        @can('view-admins')
                            <li><a class="dropdown-item" href="{{ route('backend.admin.index') }}"><i class="fas fa-fw fa-list"></i> @lang('List')</a></li>
                        @endcan
                        @can('create-admins')
                            <li><a class="dropdown-item" href="{{ route('backend.admin.create') }}"><i class="fas fa-fw fa-plus"></i> @lang('Add')</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @canany(['view-roles', 'create-roles'])
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-fw fa-user-tag"></i> @lang('Roles')</a>
                    <ul class="dropdown-menu">
                        @can('view-roles')
                            <li><a class="dropdown-item" href="{{ route('backend.role.index') }}"><i class="fas fa-fw fa-list"></i> @lang('List')</a></li>
                        @endcan
                        @can('create-roles')
                            <li><a class="dropdown-item" href="{{ route('backend.role.create') }}"><i class="fas fa-fw fa-plus"></i> @lang('Add')</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @canany(['view-permissions'])
                <li><a class="dropdown-item" href="{{ route('backend.permission.index') }}"><i class="fas fa-fw fa-lock"></i> @lang('List of :name', ['name' => __('Permissions')])</a></li>
            @endcan
        </ul>
    </li>
@endcanany
<style>

</style>