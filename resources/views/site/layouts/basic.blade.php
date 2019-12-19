<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crash Mapper - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        
    </head>
    <body>
        <div class="container">
            <header class="navbar">
                <section class="navbar-section">
                    <a href="..." class="navbar-brand mr-2">Contact us</a>
                </section>
            </header>
            @yield('content')
        </div>
    </body>

    <script src="{{ mix('js/app.js') }}"></script>
</html>