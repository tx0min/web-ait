<header class="py-3">
    <a href="#" class="nav-toggle" >
        @icon('bars')
    </a>

    <div class="container-fluid">
        <div class="row align-items-center">
            <a class="col nav-aside"  href="{{ route('home') }}">
                @svg('img/logo-ait.svg',['class'=>'img-responsive fill-primary'])
                {{-- <img src="{{ asset('img/favicon.png') }}"/> --}}
            </a>
            
            <div class="col">
                <nav id="nav-container">
                   
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

                    <ul class="nav ">
                       
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend') }}">  @icon('user-circle') {{ __('Backend') }}</a>
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
                </nav>
            </div>
        </div>
    </div>
</header>