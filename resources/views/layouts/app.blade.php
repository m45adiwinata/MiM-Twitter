<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Test MiM | @yield('title')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Styles -->
    <style>
        a {color:white;}
    </style>
    @yield('additional_style')
    
</head>
<body>
    <div id="app">
        <div class="d-flex justify-content-between" style="background-color:blue;">
            <div class="p-4 bd-highlight"></div>
            <div class="p-4 bd-highlight"><a href="{{route('home')}}">Twitter Application</a></div>
            <div class="p-4 bd-highlight">
                @if(Auth::user())
                <a href="{{route('profile', Auth::user()->id)}}">Profile</a>
                <a href="{{route('logout')}}">Logout</a>
                @endif
            </div>
        </div>
        <main>
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    @yield('additional_script')
</body>
</html>
