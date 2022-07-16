@canany(['view-admins'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-security" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Control
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSecurity">
            @canany(['view-admins'])
            <li><a class="dropdown-item" href="{{ route('backend.admin.index') }}"><i class="fas fa-fw fa-plus"></i> Cargar Producto </a></li>
            @endcan
            @canany(['view-admins'])
            <li><a class="dropdown-item" href="{{ route('backend.admin.index') }}"><i class="fas fa-fw fa-list"></i> Ver Ordenes Generadas </a></li>
            @endcan
            @canany(['view-admins'])
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-fw fa-user"></i> Exportar Reporte</a>
                    <ul class="dropdown-menu">
                        @can('view-admins')
                            <li><a class="dropdown-item" href="{{ route('backend.admin.index') }}"><i class="fas fa-fw fa-list"></i> Ordenes </a></li>
                        @endcan
                        @can('create-admins')
                            <li><a class="dropdown-item" href="{{ route('backend.admin.create') }}"><i class="fas fa-fw fa-plus"></i> Stock </a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
<style>

</style>