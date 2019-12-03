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
    <link href="{{ asset('css/Chart.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Chart.min.css') }}" rel="stylesheet">
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
@if(auth()->user()->role=="admin")
    @include('modals.customers.create_client_admin')
    @include('modals.tasks.create_task_admin')
    @include('modals.meets.create_meet_admin')
@else
    @include('modals.customers.create_client')
    @include('modals.tasks.create_task')
    @include('modals.meets.create_meet')
@endif

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
    $(document).on("click", '.addClient1',function( event ) {
        event.preventDefault();
        let callId = $('#call_id1').val();
        let btn = $(event.currentTarget);
        let name = $('#client_name1');
        let phone = $('#client_contacts1');
        let company = $('#client_company1');
        let desc = $('#client_desc1');
        let social = $('#client_socials1');
        let date = $('#client_date1');
        let status = $('#client_status1').is(':checked') ? true : false;
        let datas = [name.val(),company.val(),phone.val(),desc.val(),date.val()];
        if(datas.indexOf("") != -1){
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните вcе поля!',
                showConfirmButton: true,
                // timer: 700
            });
        }
        else if(desc.val() == '')
        {
            swal("Заполните описание!","Поле описание стало обязательным","error");
        }
        else {
            $.ajax({
                url: '{{ route('customer.store') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name.val(),
                    "phone": phone.val(),
                    "company": company.val(),
                    "social": social.val(),
                    "desc": desc.val(),
                    "date": date.val(),
                    "status": status
                },
                success: data => {
                    $('#ClientCreate').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Клиент добавлена!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    $('#CreateClient').modal('hide');
                    $('#client_name1').val('');
                    $('#client_contacts1').val('');
                    $('#client_company1').val('');
                    $('#client_desc1').val('');
                    $('#client_socials1').val('');
                    $('#customers-content').after(data.view2).show('slide', {direction: 'left'}, 400);
                    console.log(data);
                    if(data.view){
                        let result = $('#customers-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    }
                },
                error: () => {
                    console.log(0);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Возникла ошибка!',
                        showConfirmButton: false,
                        timer: 700
                    });
                }
            })
        }
    })
</script>
<script>
    $('.createCustomerAdmin').click(e => {
        e.preventDefault();
        let btn = $(e.currentTarget);
        let title = $('#client_name_admin');
        let company = $('#client_company_admin');
        let contacts = $('#client_contacts_admin');
        let socials = $('#client_socials_admin');
        let desc = $('#client_desc_admin');
        let date = $('#client_date_admin');
        let user = $('#client_manager_admin');
        let status = $('#client_status_admin');
        let datas = [title.val(),company.val(),contacts.val(),desc.val(),date.val(),user.val(),status.val()];

        if(datas.indexOf("") != -1){
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните вcе поля!',
                showConfirmButton: true,
                // timer: 700
            });
        }
        else if(desc.val().length < 20)
        {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните описание, описание должно быть больше 20 символов!',
                showConfirmButton: true,
                // timer: 700
            });
            console.log(datas);
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
                        title: 'Клиент добавлен!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    $('#CreateClientAdmin').modal('hide');
                    $('#customers-content').after(data.view2).show('slide', {direction: 'left'}, 400);
                    $('#client_name_admin').val('');
                    $('#client_desc_admin').val('');
                    $('#client_date_admin').val('');
                    $('#client_contacts_admin').val('');
                    $('#client_socials_admin').val('');
                    $('#client_company_admin').val('');
                    $('#customers-scroll').append(data.view3).show('slide', {direction: 'left'}, 400);
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
    $('.createTaskAdmin').click(e => {
        e.preventDefault();
        let btn = $(e.currentTarget);
        btn.removeClass('createTaskAdmin');
        let title = $('#task_name_admin');
        let desc = $('#task_desc_admin');
        let date = $('#task_date_admin');
        let user = $('#task_manager_admin');
        let status = $('#task_status_admin');
        let chief = 1;
        let datas = [desc.val(),date.val(),title.val()];
        if(datas.indexOf("") != -1){
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните вcе поля!',
                showConfirmButton: true,
                // timer: 700
            });
            console.log(datas);
            btn.addClass('createTaskAdmin');
        }else if(desc.val().length < 20) {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните описание, описание должно быть больше 20 символов!',
                showConfirmButton: true,
                // timer: 700
            });
            btn.addClass('createTaskAdmin');
        }
        else {
            $.ajax({
                url: 'CreateTaskAdmin',
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
                    $('#CreateTaskAdmin').modal('hide');
                    $('#tasks-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    btn.addClass('createTaskAdmin');
                    $('#tasks-content').after(data.view2).show('slide', {direction: 'left'}, 400);
                    $('#task_name_admin').val('');
                    $('#task_desc_admin').val('');
                    $('#task_date_admin').val('');
                    console.log(data);

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
<script >
    $('.createTask').click(e => {
        e.preventDefault();
        let btn = $(e.currentTarget);
        let title = $('#task_name');
        let desc = $('#task_desc');
        let date = $('#task_date');
        let status = $('#task_status');
        if(desc.val() == '')
        {
            swal("Заполните описание!","Поле описание стало обязательным","error");
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
                    $('#tasks-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    $('#tasks-content').after(data.view2).show('slide', {direction: 'left'}, 400);
                    $('#task_name').val('');
                    $('#task_desc').val('');
                    $('#task_date').val('');
                    $('#CreateTask').modal('hide');

                },
                error: () => {
                    console.log(0);
                    swal("Что то пошло не так!", "Обратитесь к Эркину за помощью))", "error");
                }
            })
        }
    })
</script>
<script>
    $('.createMeet').click(e => {
        e.preventDefault();
        let btn = $(e.currentTarget);
        btn.hide();
        let desc = $('#meet_desc');
        let date = $('#meet_date');
        let customer = $('#meet_name');
        let status = $('#meet_status');
        let datas = [desc.val(),date.val(),customer.val()];
        if(datas.indexOf("") != -1){
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните вcе поля!',
                showConfirmButton: true,
                // timer: 700
            });
            console.log(datas);
            btn.show();
        }else if(desc.val().length < 20){
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
                url: '{{route('meeting.store')}}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "description": desc.val(),
                    "deadline_date": date.val(),
                    "customer_id": customer.val(),
                    "status_id": status.val(),
                },
                success: data => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Встреча создана!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    btn.show();
                    console.log(data);
                    $('#meets-content').after(data.view2).show('slide', {direction: 'left'}, 400);
                    $('.customerid-'+data.id).remove();
                    $('#CreateMeet').modal('hide');
                    $('#meet_date').val('');
                    $('#meet_desc').val('');
                    $('#meet_customer').val('');
                    $('#meetings-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
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
<script>
    $('.createMeetAdmin').click(e => {
        e.preventDefault();
        let btn = $(e.currentTarget);
        btn.hide();
        let desc = $('#meet_desc_admin');
        let date = $('#meet_date_admin');
        var customer = $('#meet_customer_admin');
        let manager = $('#meet_manager_admin');
        let status = $('#meet_status_admin');
        let datas = [desc.val(),date.val(),customer.val()];
        if(datas.indexOf("") != -1){
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Заполните вcе поля!',
                showConfirmButton: true,
                // timer: 700
            });
            console.log(datas);
            btn.show();
        }else if(desc.val().length < 20){
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
                    "manager_id": manager.val(),
                    "status_id": status.val(),
                },
                success: data => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Встреча создана!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    btn.show();
                    $('#CreateMeetAdmin').modal('hide');
                    $('#meet_date_admin').val('');
                    $('#meet_desc_admin').val('');
                    $('#meet_customer_admin').val('');
                    $('.customerid-'+data.id).remove();
                    $('#meetings-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    $('#meets-content').after(data.view2).show('slide', {direction: 'left'}, 400);
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

<script src="{{ asset('js/Chart.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/Chart.bundle.js') }}"></script>
<script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
