<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('backend.home') }}">
            {{ config('app.name') }} - Admin
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-backend" aria-controls="navbar-backend" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon small"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-backend">
            <ul class="navbar-nav">
                @auth('backend')
                    @include('backend.menu.ventas')
                @endauth
            </ul>
            <ul class="navbar-nav">
                @auth('backend')
                    @include('backend.menu.control')
                @endauth
            </ul>
            <ul class="navbar-nav mr-auto">
                @auth('backend')
                    @include('backend.menu.security')
                @endauth
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth('backend')
                    @if (Route::has('backend.profile.edit'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.profile.edit') }}">{{ __('My Profile') }}</a>
                        </li>
                    @endif
                    {!! Form::open(array('route' => 'backend.logout', 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                        <li class="nav-item">
                            <a href="#" class="nav-link a-submit" >{{ __('Logout') }}</a>
                        </li>
                    {!! Form::close() !!}
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('backend.register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
<script>
    $(document).on('click', '.dropdown-menu a.dropdown-toggle', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });

    $(document).on('click', '.a-submit', function() {
        $(this).closest('form').submit();
    });
</script>