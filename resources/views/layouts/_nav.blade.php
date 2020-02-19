<nav class="border-bottom py-3  ">
    <button class="d-block d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <ion-icon name="menu-outline"></ion-icon>
    </button>

    <div class="container-fluid">
        <div class="row align-items-center">
            <a class="col" id="nav-aside"  href="{{ route('home') }}">
                <img src="{{ asset('img/favicon.png') }}" id="logo-ait-nav"/>
            </a>
            

            <div class="col d-none d-md-block">
                <!-- Left Side Of Navbar -->
                <div class="d-flex justify-content-between">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('associacio') }}">{{ __('Associacio') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('socis') }}">{{ __('Socis') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog') }}">{{ __('Actualitat') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('fes-te-soci') }}">{{ __('Fes-te soci!') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav ">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend') }}"><ion-icon name="person-circle-outline"></ion-icon>{{ __('Backend') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>