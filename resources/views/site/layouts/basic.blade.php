<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Street Gaurds- @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        
    </head>
    <body>
        <header>
            <div class='header-menu'>
                <span class="item logo">
                    STREET GAURDS
                    <div class="description">
                        A Crowd Sourcing Tool for Safer, Securer, and Better Structured Streets
                    </div>
                </span>
                <a href="{{ route('site.home') }}" class="item">Home</a>
                <a href="{{ route('site.about-us') }}" class="item">About us</a>
            </div>
        </header>
        <div class="container">
            @yield('content')
        </div>
    </body>

    <script src="{{ mix('js/app.js') }}"></script>
</html>