<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])
</head>

<body class="hold-transition login-page">
    <div class="login-logo text-center mb-2">
        <img src="{{ asset('img/school-logo.jpg') }}" alt="School Logo" width="200" height="80" class="img-fluid mb-2">
    </div>

    @yield('content')

    @vite(['resources/js/app.js'])

    @yield('script')
</body>

</html>
