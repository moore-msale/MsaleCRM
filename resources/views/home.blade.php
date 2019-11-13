@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }

    </style>
@endpush
@section('content')
    <?php
    $agent = New \Jenssegers\Agent\Agent();
    ?>
{{--    @dd(\App\User::find(3))--}}
    <div class="container-fluid">

            @if($agent->isPhone())
            <div class="row pt-lg-4 pt-0">
                @include('tasks.index', ['calls2' => $calls])
            </div>
                @else
            <div class="row pt-lg-4 pt-0 justify-content-center">
                @if(\Illuminate\Support\Facades\Auth::user()->role == "admin")
                @include('tasks.statistics-admin')
                @else
                    @include('tasks.statistics')
                @endif
                @include('tasks.index', ['tasks2' => $tasks])
                @include('tasks.index', ['calls2' => $calls])
                @include('tasks.index', ['meetings2' => $meetings])
                @include('tasks.index', ['customers2' => $customers])
            @endif
        </div>
    </div>
    <?php
//        \Illuminate\Support\Facades\Cookie::forever('timer','100');
//            session(['timer' => 100]);
//        dd(session('timer'));
    ?>
    @if($agent->isPhone())
        @include('modals.calls.called-modal')
        @include('modals.customers.add_customer')
        @include('modals.calls.add_1_call')
    @else
        @include('modals.tasks.create_task')
        @include('modals.calls.create_call')
        @include('modals.meets.create_meet')
        @include('modals.calls.called-modal')
        @include('modals.customers.add_customer')
        @include('modals.customers.add_potencial')
    @endif
@endsection

@push('scripts')
    @if($agent->isPhone())

        <script>
            function registerCallBtn(item) {
                item.click(function (e) {
                    e.preventDefault();
                    let btn = $(e.currentTarget);
                    let id = btn.data('id');
                    let company = btn.data('parent');
                    let phone = btn.data('parent2');
                    $('#calledModal').modal('show');
                    $('#caller_id').val(id);
                    $('#caller_company').val(company);
                    $('#caller_phone').val(phone);
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
                let company = $('#caller_company').val();
                let phone = $('#caller_phone').val();
                $('#client-company').val(company);
                $('#client-phone').val(phone);

                $('#calledModal').modal('hide');
                $('#add_customer').modal('show');
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
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                    }
                })


            })
        </script>
        <script>
            $('.addClient').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = $('#caller_id').val();
                let name = $('#client-name');
                let phone = $('#client-phone');
                let desc = $('#client-desc');
                let company = $('#client-company');
                let social = $('#client-social');
                if(desc.val() == '')
                {
                    swal("Заполните описание!","Поле описание стало обязательным","error");
                }
                else {
                    $.ajax({
                        url: '{{ route('customer.store') }}',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "name": name.val(),
                            "phone": phone.val(),
                            "desc": desc.val(),
                            "company": company.val(),
                            "social": social.val(),
                        },
                        success: data => {
                            $('#add_customer').modal('hide');
                            $('#CreateClient').modal('hide');
                            console.log(data);
                            $('#call-' + id).hide(200);
                            $('.calls_score').html(data.plan.calls_score);
                            swal("Клиент добавлен!", "Отчет был отправлен", "success");
                            $('#client-name').val('');
                            $('#client-phone').val('');
                            $('#client-company').val('');
                            $('#client-social').val('');
                            $('#client-desc').val('');
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
            $('.Call_1_add').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let company = $('#call_company');
                let phone = $('#call_number');

                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: '{{ route('call_1_add') }}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "company": company.val(),
                        "phone": phone.val(),
                    },
                    success: data => {
                        $('#Call_1_add').modal('hide');
                        console.log(data);
                        swal("Номер добавлен!","Отчет был отправлен","success");
                        let result = $('#calls-scroll').prepend(data.view).show('slide', {direction: 'left'}, 400);
                        result.find('.call-btn').each((e, i) => {
                            registerCallBtn($(i));
                        });
                    },
                    error: () => {
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                        console.log(0);
                    }
                })
            });
            registerCallBtn($('.call-btn'));
        </script>
        <script>
            $('.waitCall').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = $('#caller_id').val();
                console.log(id);
                $.ajax({
                    url: 'callw',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: data => {
                        swal("Звонок добавлен в список на перезвон!","Отчет был отправлен","success");
                        $('#calledModal').modal('hide');
                        $('#call-' + id).hide(400);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                    }
                })


            })
        </script>
        <script>
            $('.notCall').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = $('#caller_id').val();
                console.log(id);
                $.ajax({
                    url: 'calln',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: data => {
                        swal("Звонок добавлен в список не ответивших!","Отчет был отправлен","success");
                        $('#calledModal').modal('hide');
                        $('#call-' + id).hide(400);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                    }
                })


            })
        </script>
    @else
        {{--<script>--}}
            {{--setInterval(function(){--}}
                        {{--let data = '{{ \Illuminate\Support\Facades\Auth::user()->balance }}';--}}
                {{--let user_id = '{{ auth()->id() }}';--}}
                {{--let balance = parseInt($('.balance-real').html());--}}
                {{--console.log(balance);--}}
                {{--$.ajax({--}}
                    {{--url: '{{ route('balance_get') }}',--}}
                    {{--method: 'POST',--}}
                    {{--data: {--}}
                        {{--"_token": "{{ csrf_token() }}",--}}
                        {{--"user_id": user_id,--}}
                    {{--},--}}
                    {{--success: data => {--}}
                        {{--if(data.balance != balance)--}}
                        {{--{--}}
                            {{--console.log('okey');--}}
                            {{--$('.balance-real').html(data.balance);--}}
                        {{--}--}}
                        {{--// $('#TaskCreate').modal('hide');--}}
                        {{--// swal("Задача добавлена!", "Отчет был отправлен", "success");--}}
                        {{--// let result = $('#tasks-scroll').append(data.view).show('slide', {direction: 'left'}, 400);--}}
                        {{--// $('#taskname').val('');--}}
                        {{--// $('#taskdescription').val('');--}}
                        {{--// $('#taskdate').val('');--}}

                    {{--},--}}
                    {{--error: () => {--}}
                        {{--console.log(0);--}}
                        {{--// swal("Что то пошло не так!", "Обратитесь к Эркину за помощью))", "error");--}}
                    {{--}--}}
                {{--});--}}

                {{--// console.log(balance);--}}
                {{--// console.log(data2);--}}
                {{--// if(data == balance)--}}
                {{--// {--}}
                {{--//     console.log('да');--}}
                {{--// }--}}
                {{--// else {--}}
                {{--//     console.log('нет');--}}
                {{--// }--}}
            {{--}, 5000);--}}
        {{--</script>--}}
        <script>
            $('.addTask').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let title = $('#taskname');
                let desc = $('#taskdescription');
                let date = $('#taskdate');
                let user = $('#taskuser');
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
                            "user_id": user.val(),
                        },
                        success: data => {
                            $('#TaskCreate').modal('hide');
                            swal("Задача добавлена!", "Отчет был отправлен", "success");
                            let result = $('#tasks-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                            result.find('.taskDone').each((e,i) => {
                                doneTask($(i));
                            });
                            result.find('.taskDelete').each((e,i) => {
                                deleteTask($(i));
                            });

                            result.find('.taskEdit').each((e,i) => {
                                editTask($(i));
                            });
                            $('#taskname').val('');
                            $('#taskdescription').val('');
                            $('#taskdate').val('');

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
            $('.addMeeting').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = $('#meetingname');
                let desc = $('#meetingdescription');
                let date = $('#meetingdate');
                let user = $('#meetinguser');
                if(desc.val() == '')
                {
                    swal("Заполните описание!","Поле описание стало обязательным","error");
                }
                else {
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
                            swal("Встреча добавлена!", "Отчет был отправлен", "success");
                            let result = $('#meetings-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                            result.find('.meetDone').each((e,i) => {
                                doneMeet($(i));
                            });
                            result.find('.meetDelete').each((e,i) => {
                                deleteMeet($(i));
                            });

                            result.find('.meetEdit').each((e,i) => {
                                editMeet($(i));
                            });
                            $('#meetingname').val('');
                            $('#meetingdescription').val('');
                            $('#meetingdate').val('');
                        },
                        error: () => {
                            console.log(0);
                            swal("Что то пошло не так!", "Обратитесь к Эркину за помощью))", "error");
                        }
                    })
                }
            })
            registerMeetDoneBtn($('.doneMeet'));
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
                let company = $('#caller_company').val();
                let phone = $('#caller_phone').val();
                $('#client-company').val(company);
                $('#client-phone').val(phone);

                $('#calledModal').modal('hide');
                $('#add_customer').modal('show');
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
            function deleteTask(){
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
                                swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                            }
                        })
                    }


                })
            }
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
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                    }
                })


            })
        </script>
        <script>
            function doneTask(){
                $('.doneTask').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = btn.data('id');
                let details = $('#details_done_Task-' + id);
                console.log('something');
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
                            swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                        }
                    })
                }


                })    
            }
        </script>
        <script>
            function editTask(){
                $('.editTask').click(e => {
                    e.preventDefault();
                    let btn = $(e.currentTarget);
                    let id = btn.data('id');
                    let details = $('#details_update_Task-' + id);
                    let title = $('#taskchangename-' + id);
                    let desc = $('#taskchangedesc-' + id);
                    let date = $('#taskchangedate-' + id);
                    if(desc.val() == '')
                    {
                        swal("Заполните описание!","Поле описание стало обязательным","error");
                    }
                    else {
                        console.log(id);
                        if (details.val().length < 20) {
                            swal("Неправильный ввод!", "Нужно ввести в поле 'причина' не менее 20 символов для изменения!", "error");
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
                                    swal("Встреча изменена!", "Отчет был отправлен", "success");
                                    $('#task-' + id).find('.task-title').html(data.data.title);
                                    $('#task-' + id).find('.task-date').html(data.data.deadline_date);
                                    $('#task-' + id).find('.task-desc').html(data.data.description);
                                    console.log(data);
                                },
                                error: () => {
                                    console.log(0);
                                    swal("Что то пошло не так!", "Обратитесь к Эркину за помощью))", "error");
                                }
                            })
                        }
                    }
                })
            }
        </script>
        <script>
            function doneMeet(){
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
                            swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                        }
                    })
                }
                })
            }      
        </script>
        <script>
            function deleteMeet(){
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
                                swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                            }
                        })
                    }
                })
            }
        </script>
        <script>
            function editMeet(){
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
                                swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                            }
                        })
                    }
                })
            }
        </script>
        <script>
            $('.addClient').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = $('#caller_id').val();
                let name = $('#client-name');
                let phone = $('#client-phone');
                let desc = $('#client-desc');
                let company = $('#client-company');
                let social = $('#client-social');
                if(desc.val() == '')
                {
                    swal("Заполните описание!","Поле описание стало обязательным","error");
                }
                else {
                    $.ajax({
                        url: '{{ route('customer.store') }}',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "name": name.val(),
                            "phone": phone.val(),
                            "company": company.val(),
                            "desc": desc.val(),
                            "social": social.val(),
                        },
                        success: data => {
                            $('#add_customer').modal('hide');
                            $('#CreateClient').modal('hide');
                            console.log(data);
                            $('#call-' + id).hide(200);
                            $('.calls_score').html(data.plan.calls_score);
                            swal("Клиент добавлен!", "Отчет был отправлен", "success");
                            $('#client-name').val('');
                            $('#client-phone').val('');
                            $('#client-desc').val('');
                            $('#client-company').val('');
                            $('#client-social').val('');
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
            function deleteCustomer(){
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
                                $('#DeleteCustomer-' + id).modal('hide');
                                $('#customer-' + id).hide(200);
                                console.log(data);
                            },
                            error: () => {
                                console.log(0);
                                swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                            }
                        })
                    }
                })
            }
        </script>
        <script>
            function doneCustomer(){
                $('.doneCustomer').click(e => {
                    e.preventDefault();
                    let btn = $(e.currentTarget);
                    let id = btn.data('id');
                    let details = $('#details_done_Customer-' + id);

                    console.log(id);
                    if(details.val().length < 20)
                    {
                        swal("Неправильный ввод!","Нужно ввести в поле 'причина' не менее 20 символов для удаления!","error");
                    }
                    else {
                        $.ajax({
                            url: 'customerdone',
                            method: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "details": details.val(),
                                "id": id,
                            },
                            success: data => {
                                swal("Потенциальный клиент закрыт!","Отчет был отправлен","success");
                                $('#DoneCustomer-' + id).modal('hide');
                                $('#customer-' + id).hide(200);
                                console.log(data);
                            },
                            error: () => {
                                console.log(0);
                                swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                            }
                        })
                    }


                })
            }
        </script>
        <script>
            function editCustomer(){
                $('.editCustomer').click(e => {
                    e.preventDefault();
                    let btn = $(e.currentTarget);
                    let id = btn.data('id');
                    let details = $('#details_update_Customer-' + id);
                    let name = $('#customerchangename-' + id);
                    let company = $('#customerchangecompany-' + id);
                    let phone = $('#customerchangephone-' + id);
                    let social = $('#customerchangesocial-' + id);


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
                                "social": social.val(),
                                "id": id,
                            },
                            success: data => {
                                swal("Данные изменены!","Отчет был отправлен!","success");
                                $('#customer-' + id).find('.cust-name').html(data.data.name);
                                $('#customer-' + id).find('.cust-company').html(data.data.company);
                                $('#customer-' + id).find('.cust-phone').html(data.data.contacts);
                                $('#customer-' + id).find('.cust-social').html(data.data.socials);
                                $('#meet-' + data.id).find('.meet-name').html(data.data.name);
                                $('#meet-' + data.id).find('.meet-company').html(data.data.company);
                                $('#details_update_Customer-' + id).val(''),
                                    $('#customerchangename-' + id).val(''),
                                    $('#customerchangecompany-' + id).val(),
                                    $('#customerchangephone-' + id).val(),
                                    console.log(data);
                            },
                            error: () => {
                                console.log(0);
                                swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                            }
                        })
                    }
                })
            }
        </script>
        <script>
            $('.editCustomer2').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                console.log(btn.data('id'));
                let id = btn.data('id');
                let name = $('#client_name-' + id);
                let company = $('#client_company-' + id);
                let phone = $('#client_phone-' + id);
                let social = $('#client_social-' + id);
                let desc = $('#client_desc-' + id);
                let date = $('#client_date-' + id);
                if(desc.val() == '')
                {
                    swal("Заполните описание!","Поле описание стало обязательным","error");
                }
                else {

                    console.log(id);
                    $.ajax({
                        url: 'customerupdate',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "desc": desc.val(),
                            "name": name.val(),
                            "company": company.val(),
                            "phone": phone.val(),
                            "social": social.val(),
                            "date": date.val(),
                            "id": id,
                        },
                        success: data => {
                            swal("Данные изменены!", "Отчет был отправлен!", "success");
                            $('#customer-' + id).find('.cust-name').html(data.data.name);
                            $('#customer-' + id).find('.cust-company').html(data.data.company);
                            $('#customer-' + id).find('.cust-contact').html(data.data.contacts);
                            $('#customer-' + id).find('.cust-social').html(data.data.socials);
                            $('#customer-' + id).find('.cust-desc').html(data.data.desc);
                            console.log(data);
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
            $('.addPotencial').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = $('#potencialname');
                let desc = $('#potencialdescription');
                let date = $('#potencialdate');
                if(desc.val() == '')
                {
                    swal("Заполните описание!","Поле описание стало обязательным","error");
                }
                else {
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
                            swal("Потенциальный клиент добавлен!", "Отчет был отправлен", "success");
                            if (data.view) {
                                let result = $('#customers-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                                result.find('.customerDone').each((e,i) => {
                                    doneCustomer($(i));
                                });
                                result.find('.customerDelete').each((e,i) => {
                                    deleteCustomer($(i));
                                });
                            }
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
            $('.waitCall').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = $('#caller_id').val();
                console.log(id);
                $.ajax({
                    url: 'callw',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: data => {
                        swal("Звонок добавлен в список на перезвон!","Отчет был отправлен","success");
                        $('#calledModal').modal('hide');
                        $('#call-' + id).hide(400);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                    }
                })


            })
        </script>
        <script>
            $('.notCall').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = $('#caller_id').val();
                console.log(id);
                $.ajax({
                    url: 'calln',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: data => {
                        swal("Звонок добавлен в список не ответивших!","Отчет был отправлен","success");
                        $('#calledModal').modal('hide');
                        $('#call-' + id).hide(400);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                    },
                    check: data => {
                        swal("Звонок не был перемещен!","Лимит на перенос в список 'Не ответившие' превышен 20 звонков.");
                    }
                })
            })
        </script>


    @endif
@endpush
