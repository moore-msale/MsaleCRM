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
    <div class="container-fluid p-5">
        <div class="py-1 position-relative">
            <div class="search-task" style="position: absolute; top:10%; right:0%;">
                <input id="search" class="form-control" type="text" placeholder="Поиск задач">
                <div class="position-relative pt-1">
                    <div class="position-absolute search-result shadow" id="search-result" style="right: 0; top: 160%;">
                    </div>
                </div>
            </div>

        </div>
            <ul class="nav nav-tabs pb-5" id="myTab" role="tablist">
                <li class="nav-item report-tabs mr-4">
                    <a class="nav-link report-tabs-link active" id="manage-task" data-toggle="tab" href="#manage-task-content" role="tab"
                       aria-controls="home"
                       aria-selected="true">Все задачи</a>
                </li>
                @foreach(\App\User::where('role','!=','admin')->get() as $user)
                        <li class="nav-item report-tabs mr-4">
                            <a class="nav-link report-tabs-link" id="manage-task-{{$user->id}}" data-toggle="tab" href="#manage-task-content-{{$user->id}}" role="tab"
                               aria-controls="home"
                               aria-selected="true">{{ $user->name }}</a>
                        </li>
                @endforeach
            </ul>



        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="manage-task-content" role="tabpanel" aria-labelledby="home-tab">
            <div class="tab-content" id="myTabContent">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item col-15 pl-0 pr-3">
                        <ul class="nav nav-tabs pb-5" id="myTab" role="tablist">
                            <li class="nav-item report-tabs mr-4">
                                <a class="nav-link report-tabs-link active" id="task" data-toggle="tab" href="#task-now" role="tab"
                                   aria-controls="home"
                                   aria-selected="true">Невыполенные задачи</a>
                            </li>
                            <li class="nav-item report-tabs mr-4">
                                <a class="nav-link report-tabs-link" id="donetask" data-toggle="tab" href="#task-done" role="tab"
                                   aria-controls="home"
                                   aria-selected="true">Выполненные задачи</a>
                            </li>
                            <li class="nav-item report-tabs mr-4">
                                <a class="nav-link report-tabs-link" id="donetask" data-toggle="tab" href="#task-fail" role="tab"
                                   aria-controls="home"
                                   aria-selected="true">Просроченные задачи</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="task-now" role="tabpanel" aria-labelledby="home-tab">
                                <div class="tab-content" id="myTabContent">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item col-15 pl-0 pr-3 pb-3">
                                            <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                Задачи
                                            </p>
                                            {{--@dd($tasks)--}}
                                            <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Наименование задачи
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="title-task">
                                                        Описание
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Менеджер
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Сроки
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Статус выполнения
                                                    </p>
                                                </div>
                                                <div class="col-3">

                                                </div>
                                            </div>
                                            <div class="task_content" id="task_content">
                                            @foreach($tasks as $task)
                                                @if($task->status_id == 0 && \App\User::find($task->user_id)->role != 'admin')
                                                    @include('pages.Tasks.includes.task_admin')
                                                @endif
                                            @endforeach
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="task-done" role="tabpanel" aria-labelledby="home-tab">
                                <div class="tab-content" id="myTabContent">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item col-15 pl-0 pr-3 pb-3">
                                            <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                Выполненные задачи
                                            </p>
                                            <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Наименование задачи
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="title-task">
                                                        Описание
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Менеджер
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Сроки
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Статус выполнения
                                                    </p>
                                                </div>
                                                <div class="col-3">

                                                </div>

                                            </div>
                                            <div class="done_task_content" id="done_task_content">
                                                @foreach($tasks as $task)
                                                    @if($task->status_id == 1 && \App\User::find($task->user_id)->role != 'admin')
                                                        @include('pages.Tasks.includes.done_task_admin')
                                                    @endif
                                                @endforeach
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="task-fail" role="tabpanel" aria-labelledby="home-tab">
                                <div class="tab-content" id="myTabContent">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item col-15 pl-0 pr-3 pb-3">
                                            <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                Просроченные задачи
                                            </p>
                                            <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Наименование задачи
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="title-task">
                                                        Описание
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Менеджер
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Сроки
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="title-task">
                                                        Статус выполнения
                                                    </p>
                                                </div>
                                                <div class="col-3">

                                                </div>

                                            </div>
                                            <div class="fail_task_content" id="fail_task_content">
                                                @foreach($tasks as $task)
                                                    @if($task->status_id == 2 && \App\User::find($task->user_id)->role != 'admin')
                                                        @include('pages.Tasks.includes.fail_task_admin')
                                                    @endif
                                                @endforeach
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>




                    </li>
                </ul>
    </div>

        </div>


            @foreach(\App\User::where('role','!=','admin')->get() as $user)
                <div class="tab-pane fade" id="manage-task-content-{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">
                    <div class="tab-content" id="myTabContent">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-15 pl-0 pr-3">


                                <ul class="nav nav-tabs pb-5" id="myTab" role="tablist">
                                    <li class="nav-item report-tabs mr-4">
                                        <a class="nav-link report-tabs-link active" id="task-{{ $user->id }}" data-toggle="tab" href="#task-now-{{$user->id}}" role="tab"
                                           aria-controls="home"
                                           aria-selected="true">Невыполенные задачи</a>
                                    </li>
                                    <li class="nav-item report-tabs mr-4">
                                        <a class="nav-link report-tabs-link" id="donetask-{{$user->id}}" data-toggle="tab" href="#task-done-{{ $user->id }}" role="tab"
                                           aria-controls="home"
                                           aria-selected="true">Выполненные задачи</a>
                                    </li>
                                    <li class="nav-item report-tabs mr-4">
                                        <a class="nav-link report-tabs-link" id="failtask-{{$user->id}}" data-toggle="tab" href="#task-fail-{{ $user->id }}" role="tab"
                                           aria-controls="home"
                                           aria-selected="true">Просроченные задачи</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="task-now-{{ $user->id }}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="tab-content" id="myTabContent">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item col-15 pl-0 pr-3">
                                                    <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                        Задачи
                                                    </p>
                                                    {{--@dd($tasks)--}}
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Наименование задачи
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="title-task">
                                                                Описание
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Менеджер
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Сроки
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Статус выполнения
                                                            </p>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div class="task_content-{{$user->id}}" id="task_content-{{$user->id}}">
                                                    @foreach($tasks as $task)
                                                        @if($task->status_id == 0 && \App\User::find($task->user_id)->role != 'admin' && $task->user_id == $user->id)
                                                            @include('pages.Tasks.includes.task_admin')
                                                        @endif
                                                    @endforeach
                                                    </div>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="task-done-{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="tab-content" id="myTabContent">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item col-15 pl-0 pr-3">
                                                    <p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                        Выполненные задачи
                                                    </p>
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Наименование задачи
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="title-task">
                                                                Описание
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Менеджер
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Сроки
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Статус выполнения
                                                            </p>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div class="done_task-{{$user->id}}" id="done_task-{{$user->id}}">
                                                        @foreach($tasks as $task)
                                                            @if($task->status_id == 1 && \App\User::find($task->user_id)->role != 'admin' && $task->user_id == $user->id)
                                                                @include('pages.Tasks.includes.done_task_admin')
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="task-fail-{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="tab-content" id="myTabContent">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item col-15 pl-0 pr-3">
                                                    <p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                        Просроченные задачи
                                                    </p>
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Наименование задачи
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="title-task">
                                                                Описание
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Менеджер
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Сроки
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Статус выполнения
                                                            </p>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div class="fail_task-{{$user->id}}" id="fail_task-{{$user->id}}">
                                                        @foreach($tasks as $task)
                                                            @if($task->status_id == 2 && \App\User::find($task->user_id)->role != 'admin' && $task->user_id == $user->id)
                                                                @include('pages.Tasks.includes.fail_task_admin')
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>

                </div>
            @endforeach
    </div>
    </div>
@foreach($tasks as $task)
    @include('modals.tasks.done_task_admin')
    @include('modals.tasks.delete_task_admin')
    @include('modals.tasks.edit_task_admin')
    @include('modals.tasks.search_task_modal')
@endforeach

@endsection


@push('scripts')
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
                        if(data.data.status_id == 0)
                        {
                            $('#task-now-' + user).find('.task-' + data.data.id).hide(200);
                            $('#task-now').find('.task-' + data.data.id).hide(200);
                        }
                        else if(data.data.status_id == 1)
                        {
                            $('#task-done-' + user).find('.donetask-' + data.data.id).hide(200);
                            $('#task-done').find('.donetask-' + data.data.id).hide(200);
                        }
                        else if(data.data.status_id == 2)
                        {
                            $('#task-fail-' + user).find('.failtask-' + data.data.id).hide(200);
                            $('#task-fail').find('.failtask-' + data.data.id).hide(200);
                        }
                        swal("Задача удалена!","Отчет был отправлен","success");
                        $('#task-' + id).hide(200);
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
            let manage = $('#task_manage-' + id);
            if(desc.val() == '')
            {
                swal("Заполните описание!","Поле описание стало обязательным","error");
            }
            else {
                // console.log(id);
                    $.ajax({
                        url: 'EditTaskAdmin',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "title": title.val(),
                            "desc": desc.val(),
                            "date": date.val(),
                            "manage": manage.val(),
                            "id": id,
                        },
                        success: data => {
                            $('#EditTaskAdmin-' + id).modal('hide');
                            swal("Задача изменена!", "Отчет был отправлен", "success");
                            if(data.data.user_id == user) {
                                if (data.data.status_id == 0)
                                {
                                    $('#task-now').find('.task-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-now').find('.task-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-now').find('.task-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                    $('#task-now-' + user).find('.task-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-now-' + user).find('.task-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-now-' + user).find('.task-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                }
                                else if(data.data.status_id == 1)
                                {
                                    $('#task-done').find('.donetask-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-done').find('.donetask-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-done').find('.donetask-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                    $('#task-done-' + user).find('.donetask-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-done-' + user).find('.donetask-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-done-' + user).find('.donetask-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                }
                                else if(data.data.status_id == 2)
                                {
                                    $('#task-fail').find('.failtask-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-fail').find('.failtask-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-fail').find('.failtask-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                    $('#task-fail-' + user).find('.failtask-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-fail-' + user).find('.failtask-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-fail-' + user).find('.failtask-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                }
                            }
                            else
                            {
                                if(data.data.status_id == 0)
                                {
                                    $('#EditTaskAdmin-' + id).modal('hide');
                                    $('#task-now-' + user).find('.task-' + data.data.id).hide(200);
                                    let result = $('#task_content-' + data.data.user_id).append(data.view).show('slide',{direction: 'left'}, 400);
                                    $('#task-now').find('.task-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-now').find('.task-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-now').find('.task-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                    $('#task-now').find('.task-' + data.data.id).find('.task-manager').html(data.user);
                                }
                                else if(data.data.status_id == 1)
                                {
                                    $('#EditTaskAdmin-' + id).modal('hide');
                                    $('#task-done-' + user).find('.donetask-' + data.data.id).hide(200);
                                    let result = $('#done_task-' + data.data.user_id).append(data.view).show('slide',{direction: 'left'}, 400);
                                    $('#task-done').find('.donetask-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-done').find('.donetask-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-done').find('.donetask-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                    $('#task-done').find('.donetask-' + data.data.id).find('.task-manager').html(data.user);
                                }
                                else if(data.data.status_id == 2)
                                {
                                    $('#EditTaskAdmin-' + id).modal('hide');
                                    $('#task-fail-' + user).find('.failtask-' + data.data.id).hide(200);
                                    let result = $('#fail_task-' + data.data.user_id).append(data.view).show('slide', {direction: 'left'}, 400);
                                    $('#task-fail').find('.failtask-' + data.data.id).find('.task-title').html(data.data.title);
                                    $('#task-fail').find('.failtask-' + data.data.id).find('.task-desc').html(data.data.description);
                                    $('#task-fail').find('.failtask-' + data.data.id).find('.task-date').html(data.data.deadline_date);
                                    $('#task-fail').find('.failtask-' + data.data.id).find('.task-manager').html(data.user);
                                }

                            }

                            // console.log(data);
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