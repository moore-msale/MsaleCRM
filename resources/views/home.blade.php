@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid h-100">
        <div class="row h-100" style="padding-top: 2em;">
            @include('tasks.statistics')
            @include('tasks.index', ['tasks2' => $tasks])
            @include('tasks.index', ['calls2' => $calls])
            @include('tasks.index', ['meetings2' => $meetings])
            @include('tasks.index', ['customers2' => $customers])
        </div>
    </div>
    @include('modals.create_task')
    @include('modals.create_call')
    @include('modals.create_meet')
    @include('modals.create_client')
    @include('modals.called-modal')
    @include('modals.add_customer')
@endsection

@push('scripts')
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
                    console.log(data);
                    let result = $('#tasks-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
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
            let details = $('#details_delete_Task');
            let id = btn.data('id');
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
            let details = $('#details_done_Task');
            let id = btn.data('id');
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
            let details = $('#details_update_Task');
            let title = $('#taskchangename');
            let date = $('#taskchangedate');

            let id = btn.data('id');
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
                        "date": date.val(),
                        "id": id,
                    },
                    success: data => {
                        $('#task-' + id).load("/msalecrm/home #task-" + id +" > *");
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
            let details = $('#details_done_Meet');
            let id = btn.data('id');
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
            let details = $('#details_delete_Meet');
            let id = btn.data('id');
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
            let details = $('#details_update_Meet');
            let date = $('#meetchangedate');

            let id = btn.data('id');
            console.log(id);
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
                        // $('#meet-' + id).load("/msalecrm/home #task-" + id +" > *");
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
            let name = $('#clientname');
            let phone = $('#clientphone');
            let company = $('#clientcompany');
            let social = $('#clientsocial');
            let date = $('#clientdate');
            let status = $('#clientstatus').is(':checked') ? true : false;

            $.ajax({
                url: '{{ route('customer.store') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name.val(),
                    "phone": phone.val(),
                    "company": company.val(),
                    "social": social.val(),
                    "date": date.val(),
                    "status": status,
                },
                success: data => {
                    $('#add_customer').modal('hide');
                    console.log(data);
                    swal("Клиент добавлен!","Отчет был отправлен","success");
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
@endpush
