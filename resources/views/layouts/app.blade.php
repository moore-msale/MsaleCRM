<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <link rel="icon" href="//to-moore.com/images/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MOORE CRM</title>

    <!-- Scripts -->
    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            /*background-color:grey;*/
            /*background-image: url('https://to-moore.com/images/beeline.png');*/
            background-repeat: no-repeat;
            background-color: white;
            background-position: center;
        }
        .backdrop
        {
            position: fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            z-index: 99;
            display: none;
            background-color: rgba(167, 167, 167, 0.4);
        }
        @media screen and (min-width: 300px) and (max-width: 700px) {
            .preloader
            {
                background-size:80%;
            }
        }
    </style>

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    @stack('styles')
</head>
<body>
<div class="preloader"></div>

<?php
$agent = New \Jenssegers\Agent\Agent();
?>
    <div id="app">
        {{--@include('_partials.header')--}}
        <main >
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-auto px-0 d-lg-block d-none" style="width:5%;">
                        @include('_partials.sidebar')
                    </div>
                    <div class="col-lg-14 col-15 pt-0">
                        <div class="backdrop"></div>
                        @yield('content')
                    </div>
                </div>
            </div>

        </main>
    </div>
@include('modals.customers.create_client_admin')
@include('modals.tasks.create_task_admin')
@include('modals.meets.create_meet_admin')

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
    {{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
{{--<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>--}}
<script>
    function preloader() {
        $('.preloader').fadeOut('slow').delay(10000);
    };
</script>
@push('scripts')
    <script>
        $('.menu-burger').click( function () {
            if($('.menu-burger').hasClass('active'))
            {
                document.getElementById("mySidenav").style.left = "-500px";
                $('#mySidenav').hide(100);
                $('.menu-burger').removeClass('active');
                $('.backdrop').hide(10);
            }
            else
            {
                document.getElementById("mySidenav").style.left = "65px";
                $('#mySidenav').show(100);
                $('.menu-burger').addClass('active');
                $('.backdrop').show(10);
            }

        });
        $('.backdrop').click( function () {
            document.getElementById("mySidenav").style.left = "-500px";
            $('#mySidenav').hide(100);
            $('.menu-burger').removeClass('active');
            $('.backdrop').hide(10);
        });
        $('.close-menu').click( function () {
            document.getElementById("mySidenav").style.left = "-500px";
            $('#mySidenav').hide(100);
            $('.menu-burger').removeClass('active');
            $('.backdrop').hide(10);
        });

        // $('.menu-burger').click( function () {
        //
        // });
    </script>
@endpush
<script>
    setTimeout(preloader, 500);
</script>
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
    <script>
        $.ajax({
            url: '{{ route('task.index') }}',
            success: data => {
                console.log(data);
            },
            error: () => {
                console.log('error');
            }
        })
    </script>
<script>
    $(function(){
        jQuery('img.svg').each(function(){
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');

                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Check if the viewport is set, else we gonna set it if we can.
                if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                }

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');

        });
    });

</script>
<script>
    $('.createCustomerAdmin').click(e => {
        e.preventDefault();
        let btn = $(e.currentTarget);
        btn.hide();
        let title = $('#client_name');
        let company = $('#client_company');
        let contacts = $('#client_contacts');
        let socials = $('#client_socials');
        let desc = $('#client_desc');
        let date = $('#client_date');
        let user = $('#client_manager');
        let status = $('#client_status');
        if(desc.val().length < 20)
        {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните описание, описание должно быть больше 20 символов!',
                showConfirmButton: true,
                // timer: 700
            });
        }
        else {
            $.ajax({
                url: '{{ route('CreateCustomerAdmin') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "title": title.val(),
                    "company": company.val(),
                    "contacts": contacts.val(),
                    "socials": socials.val(),
                    "description": desc.val(),
                    "deadline_date": date.val(),
                    "user_id": user.val(),
                    "status": status.val(),
                },
                success: data => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Задача добавлена!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    btn.show();
                    $('#client_name').val('');
                    $('#client_desc').val('');
                    $('#client_date').val('');
                    $('#client_contacts').val('');
                    $('#client_socials').val('');
                    $('#client_company').val('');
                },
                error: () => {
                    btn.show();
                    console.log(0);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Произошла ошибка!',
                        showConfirmButton: false,
                        timer: 700
                    });
                }
            })
        }
    })
</script>
<script>
    $('.createTaskAdmin').click(e => {
        e.preventDefault();
        let btn = $(e.currentTarget);
        btn.removeClass('createTask');
        let title = $('#task_name');
        let desc = $('#task_desc');
        let date = $('#task_date');
        let user = $('#task_manager');
        let status = $('#task_status');
        let chief = 1;

        if(desc.val().length < 20)
        {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните описание, описание должно быть больше 20 символов!',
                showConfirmButton: true,
                // timer: 700
            });
        }
        else {
            $.ajax({
                url: '{{ route('task.store') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "title": title.val(),
                    "description": desc.val(),
                    "deadline_date": date.val(),
                    "user_id": user.val(),
                    "status": status.val(),
                    "chief": chief,
                },
                success: data => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Задача добавлена!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    btn.addClass('createTask');
                    $('#task_name').val('');
                    $('#task_desc').val('');
                    $('#task_date').val('');

                },
                error: () => {
                    console.log(0);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Произошла ошибка!',
                        showConfirmButton: false,
                        timer: 700
                    });
                }
            })
        }
    })
</script>
<script>
    $('.createMeetAdmin').click(e => {
        e.preventDefault();
        let btn = $(e.currentTarget);
        btn.hide();
        let desc = $('#meet_desc');
        let date = $('#meet_date');
        let customer = $('#meet_customer');

        if(desc.val().length < 20)
        {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните описание, описание должно быть больше 20 символов!',
                showConfirmButton: true,
                // timer: 700

            });
            btn.show();
        }
        else {
            $.ajax({
                url: 'CreateMeetAdmin',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "description": desc.val(),
                    "deadline_date": date.val(),
                    "customer_id": customer.val(),
                },
                success: data => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Встреча создана!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    $('#meet_date').val('');
                    $('#meet_desc').val('');
                    btn.show();
                },
                error: () => {
                    console.log(0);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Произошла ошибка!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    btn.show();
                }
            })
        }
    })
</script>

    @stack('scripts')
</body>
</html>
