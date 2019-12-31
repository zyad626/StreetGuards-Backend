<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') | Crowd4S Control Panel </title>

    <link rel="stylesheet" href="{{ mix('/admin_assets/css/app.css') }}">
</head>
<body>

    @include('admin.shared.header')

    <div class='ui container'>
        <div class='ui hidden divider'></div>
        @yield('content')
    </div>

    @include('admin.shared.footer')

    @include('admin.shared.scripts')

</body>
</html>
