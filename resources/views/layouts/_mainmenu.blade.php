<ul class="nav">
    <li class="nav-item {{ isActiveRoute('associacio') }} "  >
        <a class="nav-link" href="{{ route('associacio') }}">{{ __('Associació') }}</a>
    </li>
    <li class="nav-item {{ isActiveRoute('socis') }}">
        <a class="nav-link" href="{{ route('socis') }}">{{ __('Socis') }}</a>
    </li>
    <li class="nav-item {{ isActiveRoute('blog') }}">
        <a class="nav-link" href="{{ route('blog') }}">{{ __('Activitats') }}</a>
    </li>
    <li class="nav-item {{ isActiveRoute('fes-te-soci') }}">
        <a class="nav-link" href="{{ route('fes-te-soci') }}">{{ __('Fes-te soci!') }}</a>
    </li>
</ul>
