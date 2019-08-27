<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        @include('_partials.header')
        <main style="height:100vh;">
            <div class="container-fluid h-100">
                <div class="row h-100">
                    <div class="col-auto h-100 px-0" style="width:5%;">
                        @include('_partials.sidebar')
                    </div>
                    <div class="col-11">
                        @yield('content')
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
