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
        <main >
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-auto px-0 d-lg-block d-none" style="width:5%;">
                        @include('_partials.sidebar')
                    </div>
                    <div class="col-lg-14 col-15 pt-5">
                        @yield('content')
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        $('.addTask').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let title = $('#taskname');
            let desc = $('#taskdescription');
            let date = $('#taskdate');
            let user = $('#taskuser');

            $.ajax({
                url: '{{ route('task.store') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "title": title.val(),
                    "description": desc.val(),
                    "deadline_date": date.val(),
                    "user_id": user.val(),
                },
                success: data => {
                    $('#TaskCreate').modal('hide');
                    if (data.inWeek) {
                        let result = $('#tasks-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    }
                },
                error: () => {
                    console.log(0);
                }
            })
        })
    </script>
    <script>
        $('.addMeeting').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = $('#meetingname');
            let desc = $('#meetingdescription');
            let date = $('#meetingdate');
            let user = $('#meetinguser');

            $.ajax({
                url: '{{ route('meeting.store') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id.val(),
                    "description": desc.val(),
                    "deadline_date": date.val(),
                    "user_id": user.val(),
                },
                success: data => {
                    $('#MeetCreate').modal('hide');
                    console.log(data);
                    let result = $('#meetings-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                },
                error: () => {
                    console.log(0);
                }
            })
        })
    </script>
    <script>
        function registerCallBtn(item) {
            item.click(function (e) {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = btn.data('id');
                $('#calledModal').modal('show');
                $('#caller_id').val(id);
                let href = btn.attr('href');
                window.location.href = href;
            });
        }
    </script>
    <script>
        $('.call_add').click(function (e) {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = $('#caller_id').val();
            $('#calledModal').modal('hide');
            $('#add_customer').modal('show');


            {{--$.ajax({--}}
            {{--url: '{{ route('call_to_customer') }}',--}}
            {{--method: 'POST',--}}
            {{--data: {--}}
            {{--"_token": "{{ csrf_token() }}",--}}
            {{--"id": id,--}}
            {{--},--}}
            {{--success: data => {--}}
            {{--$('#calledModal').modal('hide');--}}
            {{--console.log(data);--}}
            {{--$('#call-' + id).hide(200);--}}
            {{--let result = $('#customers-scroll').append(data.view).show('slide', {direction: 'left'}, 400);--}}

            {{--},--}}
            {{--error: () => {--}}
            {{--console.log(0);--}}
            {{--}--}}
            {{--})--}}
        })
    </script>
    <script>
        $('.addCall').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let excel = $('#excel')[0].files[0];

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            if (excel != undefined) {
                formData.append('excel', excel);
            }
            $.ajax({
                url: '{{ route('excel.import') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: data => {
                    $('#CallCreate').modal('hide');
                    console.log(data);

                    let result = $('#calls-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    result.find('.call-btn').each((e, i) => {
                        registerCallBtn($(i));
                    });
                },
                error: () => {
                    console.log(0);
                }
            })
        })
        registerCallBtn($('.call-btn'));
    </script>
    <script>
        $('.deleteTask').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let details = $('#details_delete_Task-' + id);

            console.log(id);
            if(details.val().length < 20)
            {
                swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для удаления!","error");
            }
            else {
                $.ajax({
                    url: 'taskdelete',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "details": details.val(),
                        "id": id,
                    },
                    success: data => {
                        swal("Задача удалена!","Отчет был отправлен","success");
                        $('#task-' + id).hide(200);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            }


        })
    </script>
    <script>
        $('.deleteCall').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = $('#caller_id').val();
            console.log(id);
            $.ajax({
                url: 'calldelete',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: data => {
                    $('#calledModal').modal('hide');
                    $('.calls_score').html(data.data.calls_score);
                    $('#call-' + id).hide(400);
                    console.log(data);
                },
                error: () => {
                    console.log(0);
                }
            })


        })
    </script>
    <script>
        $('.doneTask').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let details = $('#details_done_Task-' + id);

            console.log(id);
            if(details.val().length < 20)
            {
                swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для завершения!","error");
            }
            else {
                $.ajax({
                    url: 'taskdone',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "details": details.val(),
                        "id": id,
                    },
                    success: data => {
                        $('#task-' + id).hide(400);
                        swal("Задача выполнена!","Отчет был отправлен","success");
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            }


        })
    </script>
    <script>
        $('.editTask').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let details = $('#details_update_Task-' + id);
            let title = $('#taskchangename-' + id);
            let desc = $('#taskchangedesc-' + id);
            let date = $('#taskchangedate-' + id);

            console.log(id);
            if(details.val().length < 20)
            {
                swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для изменения!","error");
            }
            else {
                $.ajax({
                    url: 'taskupdate',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "details": details.val(),
                        "title": title.val(),
                        "desc": desc.val(),
                        "date": date.val(),
                        "id": id,
                    },
                    success: data => {
                        swal("Встреча изменена!","Отчет был отправлен","success");
                        $('#task-' + id).find('.task-title').html(data.data.title);
                        $('#task-' + id).find('.task-date').html(data.data.deadline_date);
                        $('#task-' + id).find('.task-desc').html(data.data.description);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            }
        })
    </script>
    <script>
        $('.doneMeet').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let details = $('#details_done_Meet-' + id);

            console.log(id);
            if(details.val().length < 20)
            {
                swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для завершения!","error");
            }
            else {
                $.ajax({
                    url: 'meetdone',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "details": details.val(),
                        "id": id,
                    },
                    success: data => {
                        $('.meets_score').html(data.data.meets_score);
                        swal("Встреча завершена!","Отчет был отправлен","success");
                        $('#meet-' + id).hide(400);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            }
        })
    </script>
    <script>
        $('.deleteMeet').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let details = $('#details_delete_Meet-' + id);

            console.log(id);
            if(details.val().length < 20)
            {
                swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для удаления!","error");
            }
            else {
                $.ajax({
                    url: 'meetdelete',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "details": details.val(),
                        "id": id,
                    },
                    success: data => {
                        swal("Встреча удалена!","Отчет был отправлен","success");
                        $('#meet-' + id).hide(200);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            }
        })
    </script>
    <script>
        $('.editMeet').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let details = $('#details_update_Meet-' + id);
            let date = $('#meetchangedate-' + id);


            if(details.val().length < 20)
            {
                swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для изменения!","error");
            }
            else {
                $.ajax({
                    url: 'meetupdate',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "details": details.val(),
                        "date": date.val(),
                        "id": id,
                    },
                    success: data => {
                        swal("Встреча изменена!","Отчет был отправлен","success");
                        $('#meet-' + id).find('.meet-date').html(data.data.deadline_date);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            }
        })
    </script>
    <script>
        $('.addClient').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = $('#caller_id').val();
            let name = $('#client-name');
            let phone = $('#client-phone');
            let company = $('#client-company');
            let social = $('#client-social');
            let date = $('#client-date');

            $.ajax({
                url: '{{ route('customer.store') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "name": name.val(),
                    "phone": phone.val(),
                    "company": company.val(),
                    "social": social.val(),
                    "date": date.val(),
                },
                success: data => {
                    $('#add_customer').modal('hide');
                    $('#CreateClient').modal('hide');
                    console.log(data);
                    $('#call-' + id).hide(200);
                    $('.calls_score').html(data.plan.calls_score);
                    swal("Клиент добавлен!","Отчет был отправлен","success");
                },
                error: () => {
                    console.log(0);
                }
            })
        })
    </script>
    <script>
        $('.deleteCustomer').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let details = $('#details_delete_Customer-' + id);

            console.log(id);
            if(details.val().length < 20)
            {
                swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для удаления!","error");
            }
            else {
                $.ajax({
                    url: 'customerdelete',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "details": details.val(),
                        "id": id,
                    },
                    success: data => {
                        swal("Потенциальный клиент удален!","Отчет был отправлен","success");
                        $('#customer-' + id).hide(200);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            }


        })
    </script>
    <script>
        $('.editCustomer').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let details = $('#details_update_Customer-' + id);
            let name = $('#customerchangename-' + id);
            let company = $('#customerchangecompany-' + id);
            let phone = $('#customerchangephone-' + id);


            console.log(id);
            if(details.val().length < 20)
            {
                swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для изменения!","error");
            }
            else {
                $.ajax({
                    url: 'customerupdate',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "details": details.val(),
                        "name": name.val(),
                        "company": company.val(),
                        "phone": phone.val(),
                        "id": id,
                    },
                    success: data => {
                        swal("Данные изменены!","Отчет был отправлен!","success");
                        $('#customer-' + id).find('.cust-name').html(data.data.name);
                        $('#customer-' + id).find('.cust-company').html(data.data.company);
                        $('#customer-' + id).find('.cust-phone').html(data.data.contacts);
                        $('#meet-' + data.id).find('.meet-name').html(data.data.name);
                        $('#meet-' + data.id).find('.meet-company').html(data.data.company);

                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            }
        })
    </script>
    <script>
        $('.addPotencial').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = $('#potencialname');
            let desc = $('#potencialdescription');
            let date = $('#potencialdate');

            $.ajax({
                url: '{{ route('customerchange') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id.val(),
                    "desc": desc.val(),
                    "date": date.val(),
                },
                success: data => {
                    $('#addPotencial').modal('hide');
                    console.log(data);
                    swal("Потенциальный клиент добавлен!","Отчет был отправлен","success");
                    if(data.view){
                        let result = $('#customers-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    }
                },
                error: () => {
                    console.log(0);
                }
            })
        })
    </script>

    @stack('scripts')
</body>
</html>
