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
    //    dd(session('timer'));
    ?>
    {{--@dd(session('timer'));--}}

    <div class="container-fluid py-5 px-3">
        <div class="menu-bar">
            <form class="row" action="{{ route('task_filter')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="col-2">
                    <select name="manager" id="meetingname" class="browser-default custom-select border-0">
                        <option value="{{isset($manager) ? $manager : null }}">{{ isset($manager) ? \App\User::find($manager)->name. ' - ' .\App\User::find($manager)->lastname : 'Все менеджеры'}}</option>
                        @if(isset($manager))
                            <option value="{{ null }}">Все менеджеры</option>
                        @endif
                        @if(auth()->user()->role =='admin')
                            @foreach(\App\User::all() as $user)
                                @if(isset($manager) && $user->id == $manager)
                                    @continue
                                @endif
                                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->lastname }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-2">
                    <select name="status" id="meetingname" class="browser-default custom-select border-0">
                        @if(isset($status) && $status == 0)
                            <option value="0">Без статуса</option>
                        @else
                            <option value="{{isset($status) ? $status : null }}">{{ isset($status) ? \App\Status::find($status)->name : 'Все статусы'}}</option>
                            <option value="0">Без статуса</option>
                        @endif
                        @if(isset($status) )
                            <option value="{{ null }}">Все задачи</option>
                        @endif

                        @foreach(\App\Status::where('type','task')->get() as $status1)
                            @if(isset($status) && $status1->id == $status)
                                @continue
                            @endif
                            <option value="{{ $status1->id }}">{{ $status1->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <button class="new-button">
                        Применить
                    </button>
                </div>
                <div class="col-9 text-right d-flex align-items-center justify-content-end">
                    <span class="button-create mr-3" data-toggle="modal" data-target="#CreateClient" style="color:#000000;">
                        + добавить клиента
                    </span>
                    <span class="button-create mr-3" data-toggle="modal" data-target="#TaskCreate" style="color:#000000;">
                        + добавить задачу
                    </span>
                    <span class="button-create" data-toggle="modal" data-target="#CreateMeet" style="color:#000000;">
                        + добавить встречу
                    </span>
                </div>
            </form>
            <div class="row pt-4">
                <div class="col-6">
                    <div class="search">
                        <input id="search" class="form-control" style="height:55px;" type="text" placeholder="Поиск среди задач">
                        <div class="position-relative">
                            <div class="position-absolute search-result shadow bg-white" id="search-result" style="right: 0; top: 160%;width:100%; z-index:999;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-block pt-4" style="height:40vh;">
            <h2 class="pb-3">Задачи</h2>
            <div class="row mb-3 py-2 sf-light" style="border-bottom:1px solid #DEDEDE; color:#a8a8a8;">
                <div class="col-2 pr-0">
                    Название
                </div>
                <div class="col-4">
                    Описание
                </div>
                <div class="col-2">
                    Менеджер
                </div>
                <div class="col-2">
                    Сроки
                </div>
                <div class="col-2">
                    Статус
                </div>

                <div class="col-2">
                    Дата создания
                </div>
                <div class="col-3">

                </div>
            </div>
            @foreach($tasks as $task)
                @if(\App\User::find($task->user_id)->role == 'admin')
                    <div class="row py-2 my-1 sf-light position-relative" id="task-{{$task->id}}" style="border: 0.5px solid rgba(255, 0, 0, 0.5)!important;">
                        @else
                            <div class="row py-2 my-1 sf-light position-relative" id="task-{{$task->id}}">
                                @endif
                                <div class="col-2 task-name" style="border-right:1px solid #dedede;">
                                    {{ $task->title }}
                                </div>
                                <div class="col-4 task-desc" style="border-right:1px solid #dedede;">
                                    {{ str_limit($task->description, $limit = 25, $end = '...') }}
                                </div>
                                <div class="col-2 task-manager" style="border-right:1px solid #dedede;">
                                    {{ \App\User::find($task->user_id)->name }}
                                </div>
                                <div class="col-2 task-deadline">
                                    {{ \Carbon\Carbon::parse($task->deadline_date)->format('M d - H:i') }}
                                </div>
                                <div class="col-2 task-status">
                                    @if(isset($task->status))
                                        <button style="width:100%; height:100%; color:white; background: {{ $task->status->color }}; border-radius: 20px; border:0px;" disabled>
                                            {{ $task->status->name }}
                                        </button>
                                    @else
                                        <button style="width:100%; height:100%; color:white; background: #3B79D6; border-radius: 20px; border:0px;" disabled>
                                            В работе
                                        </button>
                                    @endif
                                </div>
                                <div class="col-2 task-date">
                                    {{ \Carbon\Carbon::parse($task->created_at)->format('M d - H:i') }}
                                </div>
                                <div class="btn-group dropleft col-1">
                                    <i class="fas fa-ellipsis-v w-100" data-toggle="dropdown" style="color:#C4C4C4; cursor: pointer;"></i>
                                    <div class="dropdown-menu pl-2" style="border-radius: 0px; border:none;">
                                        <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#EditTask-{{$task->id}}" style="cursor:pointer;">изменить</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
        </div>
    </div>
    @foreach($tasks as $task)
        @include('modals.tasks.edit_task')
        @include('modals.tasks.search_task_modal')
    @endforeach
    @include('modals.customers.create_client')
    @include('modals.tasks.create_task')
    @include('modals.meets.create_meet')
@endsection


@push('scripts')
    <script>
        let result = $('#search-result');
        result.parent().hide(0);
        $('#search').on('keyup click', function () {
            let value = $(this).val();
            console.log(value);
            if (value != '' && value.length >= 1) {
                // let searchBtn = $('#search-btn');
                // searchBtn.prop('href', '');
                // searchBtn.prop('href', '/search?search=' + value);
                $.ajax({
                    url: '{!! route('search_task') !!}',
                    data: {'search': value},
                    success: (data) => {
                        console.log(data);
                        result = result.html(data.html);
                        result.parent().slideDown(400);
                        result.siblings('span').css('opacity', 1);
                        // result.find('.collapse').each((e, i) => {
                        //     registerCollapse($(i));
                        // });
                        // registerCollapse(result);
                    },
                    error: () => {
                        console.log('error');
                    }
                });
            } else {
                result.parent().slideUp(400);
                result.empty();
            }
        });

        $(document).click(function(event) {
            if (!$(event.target).is("#search, #search-result, #search-result-ajax, .collapse, .products")) {
                $("#search-result").parent().slideUp(400);
            }
        });
    </script>
    <script>
        $('.createMeet').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = $('#meet_name');
            let desc = $('#meet_desc');
            let date = $('#meet_date');
            let user = $('#meet_user');
            if(desc.val() == '')
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
                        $('#CreateMeet').modal('hide');
                        // console.log(data);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Встреча создана!',
                            showConfirmButton: false,
                            timer: 700
                        });
                        let result = $('#meetings-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                        $('#meet_name').val('');
                        $('#meet_desc').val('');
                        $('#meet_date').val('');
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
                        $('#TaskCreate').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Задача добавлена!',
                            showConfirmButton: false,
                            timer: 700
                        });
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
                        $('#task_name').val('');
                        $('#task_desc').val('');
                        $('#task_date').val('');

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
        $('.doneTask').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let user = btn.data('parent');
            let id = btn.data('id');

            // console.log(id);
            $.ajax({
                url: 'DoneTaskAdmin',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: data => {
                    $('#DoneTaskAdmin-' + id).modal('hide');
                    $('#task-now').find('.task-' + data.data.id).hide(200);
                    console.log(data.view);
                    console.log($('#done_task_content').html());
                    let result = $('#done_task_content').append(data.view).show('slide',{direction: 'left'}, 400);
                    $('#task-now-' + user).find('.task-' + data.data.id).hide(200);
                    $('#done_task-' + data.data.user_id).append(data.view).show('slide', {direction: 'left'}, 400);

                    swal("Задача выполнена!","Отчет был отправлен","success");
                },
                error: () => {
                    console.log(0);
                    swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                }
            })
        })
    </script>
    <script>
        $('.deleteTask').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let user = btn.data('parent');
            console.log(id);
            $.ajax({
                url: 'DeleteTaskAdmin',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: data => {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Задача удалена!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    $('#task-' + id).hide();
                    $('#DeleteTaskAdmin-' + id).modal('hide');
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
        $('.editTask').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let user = btn.data('parent');
            let title = $('#task_name-' + id);
            let desc = $('#task_desc-' + id);
            let date = $('#task_date-' + id);
            let status = $('#task_status-' + id);
            if(desc.val() == '')
            {
                swal("Заполните описание!","Поле описание стало обязательным","error");
            }
            else {
                $.ajax({
                    url: 'task/'+id,
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "title": title.val(),
                        "desc": desc.val(),
                        "date": date.val(),
                        "status": status.val(),
                        "id": id,
                    },
                    success: data => {
                     if(data.status == "success"){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Данные изменены!',
                            showConfirmButton: false,
                            timer: 700
                        });
                        console.log(data);
                        $('#task-' + id).find('.task-name').html(data.task.title);
                        $('#task-' + id).find('.task-deadline').html(data.deadline_date);
                        if (data.task.description.length > 25)
                            $('#task-' + id).find('.task-desc').html(data.task.description.substring(0,25) + '...');
                        else
                            $('#task-' + id).find('.task-desc').html(data.task.description);
                        if(data.status_id){
                            $('#task-' + id).find('.task-status button').html(data.status_id.name).css("background-color",data.status_id.color);
                        }else{
                            $('#task-' + id).find('.task-status button').html('В работе').css("background-color",'#3B79D6');
                        }
                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Изменение не найдены!',
                            showConfirmButton: false,
                            timer: 700
                        });
                        console.log(data);
                    }
                    },
                    error: () => {
                        console.log(0);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Что-то пошло не так!',
                            showConfirmButton: false,
                            timer: 700
                        });
                    }
                })
            }
        })
    </script>
    <script>
        let result = $('#search-result');

        result.parent().hide(0);
        $('#search').on('keyup click', function () {
            let value = $(this).val();
            console.log(value);
            if (value != '' && value.length >= 3) {
                // let searchBtn = $('#search-btn');
                // searchBtn.prop('href', '');
                // searchBtn.prop('href', '/search?search=' + value);
                $.ajax({
                    url: '{!! route('search_task') !!}',
                    data: {'search': value},
                    success: (data) => {
                        console.log(data);
                        result = result.html(data.html);
                        result.parent().slideDown(400);
                        result.siblings('span').css('opacity', 1);
                        // result.find('.collapse').each((e, i) => {
                        //     registerCollapse($(i));
                        // });
                        // registerCollapse(result);
                    },
                    error: () => {
                        console.log('error');
                    }
                });
            } else {
                result.parent().slideUp(400);
                result.empty();
            }
        });

        // function registerCollapse(i)
        // {
        //     i.on('show.bs.collapse', e => {
        //         let btn = $(e.currentTarget);
        //         let icons = $(btn.siblings('.collapses').find('span')[1]).find('i');
        //         let firstIcon = $(icons[0]);
        //         let secondIcon = $(icons[1]);
        //         firstIcon.addClass('d-none');
        //         secondIcon.removeClass('d-none');
        //         console.log(icons);
        //     });
        //     i.on('hide.bs.collapse', e => {
        //         let btn = $(e.currentTarget);
        //         let icons = $(btn.siblings('.collapses').find('span')[1]).find('i');
        //         let firstIcon = $(icons[0]);
        //         let secondIcon = $(icons[1]);
        //         secondIcon.addClass('d-none');
        //         firstIcon.removeClass('d-none');
        //         console.log(icons);
        //     });
        // }

        // $('.collapse.collapse-multi').on('show.bs.collapse', e => {
        //     console.log(e);
        // });

        $(document).click(function(event) {
            if (!$(event.target).is("#search, #search-result, #search-result-ajax, .collapse, .products")) {
                $("#search-result").parent().slideUp(400);
            }
        });
    </script>
@endpush

