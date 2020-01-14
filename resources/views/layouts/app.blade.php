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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="{{route('home')}}">SocialApp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container">
                <ul class="navbar-nav mx-auto">
                    {{--                <li class="nav-item active">--}}
                    {{--                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>--}}
                    {{--                </li>--}}
                    {{--                <li class="nav-item">--}}
                    {{--                    <a class="nav-link" href="#">Link</a>--}}
                    {{--                </li>--}}
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                     <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{auth()->user()->name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="document.getElementById('logout').submit()">Cerrar Sesión</a>
                            </div>
                            <form action="{{route('logout')}}" method="POST" id="logout">@csrf</form>
                        </li>
                    @endguest
                </ul>
            </div>

        </div>
    </nav>

</div>
<main class="py-4">
    @yield('content')
</main>

</body>
</html>
