<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown-locale" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ \Arr::get(config('app.locales'), config('app.locale')) }}
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbar-dropdown-locale">
        @foreach(config('app.locales') as $locale => $display_name)
            <li>
                <a class="dropdown-item {{ \App::getLocale() == $locale ? ' disabled' : '' }}" data-target="#locale-form-{{ $locale }}" href="{{ route('backend.locale', $locale) }}"
                   onclick="event.preventDefault(); $($(this).data('target')).submit();"
                >
                    {{ $display_name }}
                </a>
                <form id="locale-form-{{ $locale }}" action="{{ route('backend.locale', $locale) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                </form>
            </li>
        @endforeach
    </ul>
</li>
