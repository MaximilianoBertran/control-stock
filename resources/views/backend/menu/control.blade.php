@canany(['view-admins'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-security" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Control
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSecurity">
            @canany(['view-admins'])
            <li><a class="dropdown-item" href="{{ route('backend.product.index') }}"><i class="fas fa-fw fa-plus"></i> Cargar Producto </a></li>
            @endcan
            @canany(['view-admins'])
            <li><a class="dropdown-item" href="{{ route('backend.admin.index') }}"><i class="fas fa-fw fa-list"></i> Ver Ordenes Generadas </a></li>
            @endcan
        </ul>
    </li>
@endcanany
<style>

</style>