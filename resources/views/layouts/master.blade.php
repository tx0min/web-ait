<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>

</head>
<body>
    <div id="app">
        
        @include('layouts._nav')

        <div class="container-fluid "  >
            <div class="row">
                <aside class="d-none d-md-block " id="main-aside">
                    <a href="{{ route('home')}}">
                        @svg('img/logo-ait.svg',['id'=>'main-logo','class'=>'img-responsive fill-primary m-4'])
                    </a>
                </aside>
                <main class="col pt-5">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

</body>
</html>
