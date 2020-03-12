<header class="py-3">
    <a href="#" class="nav-toggle" >
        @icon('bars')
    </a>

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col nav-aside">
                <a class=""  href="{{ route('home') }}">
                    @svg('img/logo-ait.svg',['class'=>'img-responsive fill-primary'])
                    {{-- <img src="{{ asset('img/favicon.png') }}"/> --}}
                </a>
            </div>
            
            <div class="col">
                <nav id="nav-container">
                   
                    <ul class="nav">
                        <li class="nav-item {{ isActiveRoute('associacio') }} "  >
                            <a class="nav-link" href="{{ route('associacio') }}">{{ __('Associació') }}</a>
                        </li>
                        <li class="nav-item {{ isActiveRoute('socis') }}">
                            <a class="nav-link" href="{{ route('socis') }}">{{ __('Socis') }}</a>
                        </li>
                        <li class="nav-item {{ isActiveRoute('blog') }}">
                            <a class="nav-link" href="{{ route('blog') }}">{{ __('Actualitat') }}</a>
                        </li>
                        <li class="nav-item {{ isActiveRoute('fes-te-soci') }}">
                            <a class="nav-link" href="{{ route('fes-te-soci') }}">{{ __('Fes-te soci!') }}</a>
                        </li>
                    </ul>

                    <ul class="nav ">
                       
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">@icon('door-open') {{ __('Accedir') }}</a>
                            </li>
                            
                        @else
                            <li class="nav-item {{ isActiveRoute('backend') }} ">
                                <a class="nav-link" href="{{ route('backend') }}">  @icon('user-circle') {{ Auth::user()->displayName() }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" >  @icon('sign-out-alt') {{ __('Sortir') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                    @csrf
                                    {{-- <button type="submit" class="nav-link btn btn-link">{{ __('Logout') }}</button> --}}
                                </form>
                            </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>