<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Street Guards- @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        
    </head>
    <body>
        <header>
            <div class='header-menu'>
                <span class="item logo">
                    STREET GUARDS
                    <div class="description">
                        A Crowd Sourcing Tool for Safer, Securer, and Better Structured Streets
                    </div>
                </span>
                <span class='active'>
                    <a href="{{ route('site.home') }}" class="item">Home</a>
                    <a href="{{ route('site.about-us') }}" class="item">About us</a>
                </span>
            </div>
            <span class='mobile-list'>
                <div></div>
                <div></div>
                <div></div>
            </span>
        </header>
        <div class="container">
            @yield('content')
        </div>
    </body>

    <script src="{{ mix('js/app.js') }}"></script>
</html>