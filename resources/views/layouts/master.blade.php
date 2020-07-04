<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/main.css')}}">

    <title>@yield('title')</title>

</head>
<body>
@include('includes.header')
<div class="container">

    @yield('content')
</div>

    <script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{ asset('src/js/app.js') }}"></script>

</body>
</html>
