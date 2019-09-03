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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        @include('_partials.header')
        <main style="height: 90vh;">
            <div class="container-fluid h-100">
                <div class="row h-100">
                    <div class="col-auto h-100 px-0 d-lg-block d-none" style="width:5%;">
                        @include('_partials.sidebar')
                    </div>
                    <div class="col-lg-14 col-15 h-100 mt-5">
                        @yield('content')
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.date').bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.date-format').bootstrapMaterialDatePicker({
                format: 'dddd DD MMMM YYYY HH:mm',
                minDate : new Date()
            });
        });
    </script>
@stack('scripts')
</body>
</html>
