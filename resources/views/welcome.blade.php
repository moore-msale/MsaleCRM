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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <style>
        body
        {
            background:black;
        }
        nav
        {
            position: absolute;
            top:75%;
            left:50%;
            transform: translate(-50%,-50%);
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            --c: #321163;
            color: var(--c);
            font-size: 16px;
            border: 0.1em solid var(--c);
            border-radius: 0.5em;
            width: 12em;
            height: 3em;
            text-transform: uppercase;
            font-weight: bold;
            font-family: sans-serif;
            letter-spacing: 0.1em;
            text-align: center;
            line-height: 3em;
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: 0.5s;
            margin: 1em;
        }

        nav ul li span {
            position: absolute;
            width: 25%;
            height: 100%;
            background-color: var(--c);
            transform: translateY(150%);
            border-radius: 50%;
            left: calc((var(--n) - 1) * 25%);
            transition: 0.5s;
            transition-delay: calc((var(--n) - 1) * 0.1s);
            z-index: -1;
        }

        nav ul li:hover {
            color: black;
        }

        nav ul li:hover span {
            transform: translateY(0) scale(2);
        }

        nav ul li span:nth-child(1) {
            --n: 1;
        }

        nav ul li span:nth-child(2) {
            --n: 2;
        }

        nav ul li span:nth-child(3) {
            --n: 3;
        }

        nav ul li span:nth-child(4) {
            --n: 4;
        }
        .enter
        {
            opacity:0;
            animation: 1.5s shower ease forwards 3s;
        }
        @keyframes shower {
            from
            {
                opacity: 0;
            }
            to
            {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<div class="w-100 hide-bg" style="height: 100vh;">
            <svg width="475" height="104" id="logo" viewBox="0 0 475 104" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M103.723 99.7676H85.9907V35.5635H85.4634L59.6235 98.8447H47.0991L21.2593 35.5635H20.7319V99.7676H3V4.64795H26.0713L53.0977 72.082H53.625L80.6514 4.64795H103.723V99.7676Z" stroke="white" stroke-width="5"/>
                <path d="M128.903 16.2495C137.165 7.4165 148.349 3 162.456 3C176.562 3 187.724 7.4165 195.942 16.2495C204.204 25.0825 208.334 37.0796 208.334 52.2407C208.334 67.3579 204.204 79.333 195.942 88.166C187.68 96.999 176.518 101.416 162.456 101.416C148.349 101.416 137.165 96.999 128.903 88.166C120.686 79.333 116.577 67.3579 116.577 52.2407C116.577 37.0796 120.686 25.0825 128.903 16.2495ZM181.044 28.4443C176.43 22.5557 170.234 19.6113 162.456 19.6113C154.677 19.6113 148.459 22.5557 143.801 28.4443C139.187 34.333 136.879 42.2651 136.879 52.2407C136.879 62.1724 139.187 70.0825 143.801 75.9712C148.415 81.8159 154.633 84.7383 162.456 84.7383C170.234 84.7383 176.43 81.8159 181.044 75.9712C185.659 70.0825 187.966 62.1724 187.966 52.2407C187.966 42.2651 185.659 34.333 181.044 28.4443Z" stroke="white" stroke-width="5"/>
                <path d="M230.549 16.2495C238.811 7.4165 249.995 3 264.101 3C278.208 3 289.37 7.4165 297.587 16.2495C305.849 25.0825 309.98 37.0796 309.98 52.2407C309.98 67.3579 305.849 79.333 297.587 88.166C289.326 96.999 278.164 101.416 264.101 101.416C249.995 101.416 238.811 96.999 230.549 88.166C222.331 79.333 218.222 67.3579 218.222 52.2407C218.222 37.0796 222.331 25.0825 230.549 16.2495ZM282.69 28.4443C278.076 22.5557 271.879 19.6113 264.101 19.6113C256.323 19.6113 250.104 22.5557 245.446 28.4443C240.832 34.333 238.525 42.2651 238.525 52.2407C238.525 62.1724 240.832 70.0825 245.446 75.9712C250.061 81.8159 256.279 84.7383 264.101 84.7383C271.879 84.7383 278.076 81.8159 282.69 75.9712C287.304 70.0825 289.611 62.1724 289.611 52.2407C289.611 42.2651 287.304 34.333 282.69 28.4443Z" stroke="white" stroke-width="5"/>
                <path d="M342.741 20.2046V50.5269H359.88C364.89 50.5269 368.779 49.1865 371.547 46.5059C374.36 43.8252 375.766 40.1118 375.766 35.3657C375.766 30.7515 374.316 27.082 371.416 24.3574C368.515 21.5889 364.604 20.2046 359.682 20.2046H342.741ZM342.741 64.9629V99.7676H322.834V4.64795H361.792C372.646 4.64795 381.083 7.35059 387.104 12.7559C393.168 18.1172 396.201 25.522 396.201 34.9702C396.201 41.1665 394.663 46.7036 391.586 51.5815C388.554 56.4155 384.335 59.8872 378.93 61.9966L398.969 99.7676H376.425L358.693 64.9629H342.741Z" stroke="white" stroke-width="5"/>
                <path d="M472.336 83.2881V99.7676H409.318V4.64795H472.336V21.0615H429.226V44.001H469.897V59.2939H429.226V83.2881H472.336Z" stroke="white" stroke-width="5"/>
            </svg>
            <span class="sf-bold crm" style="font-size: 115px; color: white; position: absolute; top:50%; left:50%; transform: translate(20%,-45%)">
                .CRM
            </span>

    <br>

    <nav class="enter">
        <ul>
            <li>
                <a href="/login" class="text-white">
                Войти
                <span></span><span></span><span></span><span></span>
                </a>
            </li>
        </ul>
    </nav>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
</div>
</body>
</html>
