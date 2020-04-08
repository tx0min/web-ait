<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="google-site-verification" content="PH5Dmz-U03jFKy7e_3iyiiJwf6syO_XPfr7J7Jyg98U" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('') }}">

    <title>{{ config('app.name', 'AIT') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>

</head>
<body class="@yield('class')" style="@yield('style')">
    <div id="app" >

        @include('layouts._header')

        <div class="container-fluid "  >
            <div class="row main-row">
                <aside class="col" id="main-aside">
                    <a href="{{ route('home')}}" class="d-block anim from-bottom in">
                        @svg('img/logo-ait.svg',['id'=>'main-logo','class'=>'img-responsive fill-primary'])
                    </a>
                </aside>
                <main class="col">
                    @yield('content')
                </main>
            </div>
        </div>
        @yield('footer')

    </div>


</body>
</html>
