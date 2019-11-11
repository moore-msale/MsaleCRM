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
    <div class="container-fluid p-5">
        <ul class="nav nav-tabs pb-5" id="myTab" role="tablist">
            <li class="nav-item report-tabs mr-4">
                <a class="nav-link report-tabs-link active" id="manage-task" data-toggle="tab" href="#manage-task-content" role="tab"
                   aria-controls="home"
                   aria-selected="true">Все встречи</a>
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
                                       aria-selected="true">Незавершенные встречи</a>
                                </li>
                                <li class="nav-item report-tabs mr-4">
                                    <a class="nav-link report-tabs-link" id="donetask" data-toggle="tab" href="#task-done" role="tab"
                                       aria-controls="home"
                                       aria-selected="true">Завершенные встречи</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="task-now" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="tab-content" id="myTabContent">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item col-15 pl-0 pr-3 pb-3">
                                                <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                    Незавершенные встречи
                                                </p>
                                                {{--@dd($tasks)--}}
                                                <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Имя
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Компания
                                                        </p>
                                                    </div>
                                                    <div class="col-3">
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
                                                    <div class="col-2">

                                                    </div>
                                                </div>
                                                <div class="task_content" id="task_content">
                                                    @foreach($tasks as $task)
                                                        @if($task->status_id == 0 && \App\User::find($task->user_id)->role != 'admin')
                                                            @include('pages.Meets.includes.meet_admin')
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
                                                    Выполненные встречи
                                                </p>
                                                <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Имя
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Компания
                                                        </p>
                                                    </div>
                                                    <div class="col-3">
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
                                                    <div class="col-2">

                                                    </div>

                                                </div>
                                                <div class="done_task_content" id="done_task_content">
                                                    @foreach($tasks as $task)
                                                        @if($task->status_id == 1 && \App\User::find($task->user_id)->role != 'admin')
                                                            @include('pages.Meets.includes.done_meet_admin')
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
                                           aria-selected="true">Незавершенные встречи</a>
                                    </li>
                                    <li class="nav-item report-tabs mr-4">
                                        <a class="nav-link report-tabs-link" id="donetask-{{$user->id}}" data-toggle="tab" href="#task-done-{{ $user->id }}" role="tab"
                                           aria-controls="home"
                                           aria-selected="true">Завершенные задачи</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="task-now-{{ $user->id }}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="tab-content" id="myTabContent">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item col-15 pl-0 pr-3">
                                                    <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                        Незавершенные встречи
                                                    </p>
                                                    {{--@dd($tasks)--}}
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Имя
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Компания
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
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
                                                        <div class="col-2">

                                                        </div>
                                                    </div>
                                                    <div class="task_content-{{$user->id}}" id="task_content-{{$user->id}}">
                                                        @foreach($tasks as $task)
                                                            @if($task->status_id == 0 && \App\User::find($task->user_id)->role != 'admin' && $task->user_id == $user->id)
                                                                @include('pages.Meets.includes.meet_admin')
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
                                                        Завершенные задачи
                                                    </p>
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Имя
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Компания
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
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
                                                        <div class="col-2">

                                                        </div>
                                                    </div>
                                                    <div class="done_task-{{$user->id}}" id="done_task-{{$user->id}}">
                                                        @foreach($tasks as $task)
                                                            @if($task->status_id == 1 && \App\User::find($task->user_id)->role != 'admin' && $task->user_id == $user->id)
                                                                @include('pages.Meets.includes.done_meet_admin')
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






















    {{--<div class="container-fluid p-5">--}}
        {{--<ul class="nav nav-tabs pb-5" id="myTab" role="tablist">--}}
            {{--<li class="nav-item report-tabs mr-4">--}}
                {{--<a class="nav-link report-tabs-link active" id="manage-task" data-toggle="tab" href="#manage-meet-content" role="tab"--}}
                   {{--aria-controls="home"--}}
                   {{--aria-selected="true">Все встречи</a>--}}
            {{--</li>--}}
            {{--@foreach(\App\User::where('role','!=','admin')->get() as $user)--}}
                {{--<li class="nav-item report-tabs mr-4">--}}
                    {{--<a class="nav-link report-tabs-link" id="manage-meet-{{$user->id}}" data-toggle="tab" href="#manage-meet-content-{{$user->id}}" role="tab"--}}
                       {{--aria-controls="home"--}}
                       {{--aria-selected="true">{{ $user->name }}</a>--}}
                {{--</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}

        {{--<div class="tab-content" id="myTabContent">--}}
            {{--<div class="tab-pane fade active show" id="manage-meet-content" role="tabpanel" aria-labelledby="home-tab">--}}
                {{--<div class="tab-content" id="myTabContent">--}}
                    {{--<ul class="nav nav-tabs" id="myTab" role="tablist">--}}
                        {{--<li class="nav-item col-15 pl-0 pr-3">--}}
                            {{--<ul class="nav nav-tabs pb-5" id="myTab" role="tablist">--}}
                                {{--<li class="nav-item report-tabs mr-4">--}}
                                    {{--<a class="nav-link report-tabs-link active" id="meet" data-toggle="tab" href="#meet-now" role="tab"--}}
                                       {{--aria-controls="home"--}}
                                       {{--aria-selected="true">Незавершенные встречи</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item report-tabs mr-4">--}}
                                    {{--<a class="nav-link report-tabs-link" id="donemeet" data-toggle="tab" href="#meet-done" role="tab"--}}
                                       {{--aria-controls="home"--}}
                                       {{--aria-selected="true">Завершенные встречи</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--<div class="tab-content" id="myTabContent">--}}
                                {{--<div class="tab-pane fade active show" id="meet-now" role="tabpanel"--}}
                                     {{--aria-labelledby="home-tab">--}}
                                    {{--<div class="tab-content" id="myTabContent">--}}
                                        {{--<ul class="nav nav-tabs" id="myTab" role="tablist">--}}
                                            {{--<li class="nav-item col-15 pl-0 pr-3 pb-3">--}}
                                                {{--<p class="h2 font-weight-bold py-5"--}}
                                                   {{--style="font-size:23px; line-height: 27px; color:#545454">--}}
                                                    {{--Незавершенные встречи--}}
                                                {{--</p>--}}
                                                {{--@dd($tasks)--}}
                                                {{--<div class="row" style="border-bottom: 1px solid #DEDEDE;">--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Имя--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Компания--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-3">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Описание--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Менеджер--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Сроки--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Статус выполнения--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}

                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--@foreach($tasks as $task)--}}
                                                    {{--@if($task->status_id != 1 && \App\User::find($task->user_id)->role != 'admin')--}}
                                                        {{--@include('pages.Meets.includes.meet_admin')--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane fade" id="meet-done" role="tabpanel" aria-labelledby="home-tab">--}}
                                    {{--<div class="tab-content" id="myTabContent">--}}
                                        {{--<ul class="nav nav-tabs" id="myTab" role="tablist">--}}
                                            {{--<li class="nav-item col-15 pl-0 pr-3 pb-3">--}}
                                                {{--<p class="h2 font-weight-bold py-5"--}}
                                                   {{--style="font-size:23px; line-height: 27px; color:#545454">--}}
                                                    {{--Завершенные встречи--}}
                                                {{--</p>--}}
                                                {{--<div class="row" style="border-bottom: 1px solid #DEDEDE;">--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Имя--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Компания--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-3">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Описание--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Менеджер--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Сроки--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}
                                                        {{--<p class="title-task">--}}
                                                            {{--Статус выполнения--}}
                                                        {{--</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-2">--}}

                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="content-tasker" id="content-tasker">--}}
                                                    {{--@foreach($tasks as $task)--}}
                                                        {{--@if($task->status_id == 1 && \App\User::find($task->user_id)->role != 'admin')--}}
                                                            {{--@include('pages.Meets.includes.done_meet_admin')--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}

            {{--</div>--}}


            {{--@foreach(\App\User::where('role','!=','admin')->get() as $user)--}}
                {{--<div class="tab-pane fade" id="manage-meet-content-{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">--}}
                    {{--<div class="tab-content" id="myTabContent">--}}
                        {{--<ul class="nav nav-tabs" id="myTab" role="tablist">--}}
                            {{--<li class="nav-item col-15 pl-0 pr-3">--}}

                                {{--<ul class="nav nav-tabs pb-5" id="myTab" role="tablist">--}}
                                    {{--<li class="nav-item report-tabs mr-4">--}}
                                        {{--<a class="nav-link report-tabs-link active" id="meet-{{ $user->id }}" data-toggle="tab" href="#meet-now-{{$user->id}}" role="tab"--}}
                                           {{--aria-controls="home"--}}
                                           {{--aria-selected="true">Незавершенные встречи</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="nav-item report-tabs mr-4">--}}
                                        {{--<a class="nav-link report-tabs-link" id="donemeet-{{$user->id}}" data-toggle="tab" href="#meet-done-{{ $user->id }}" role="tab"--}}
                                           {{--aria-controls="home"--}}
                                           {{--aria-selected="true">Выполненные задачи</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}


                                {{--<div class="tab-content" id="myTabContent">--}}
                                    {{--<div class="tab-pane fade active show" id="meet-now-{{ $user->id }}" role="tabpanel" aria-labelledby="home-tab">--}}
                                        {{--<div class="tab-content" id="myTabContent">--}}
                                            {{--<ul class="nav nav-tabs" id="myTab" role="tablist">--}}
                                                {{--<li class="nav-item col-15 pl-0 pr-3">--}}
                                {{--<p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">--}}
                                    {{--Незавершенные встречи--}}
                                {{--</p>--}}
                                {{--@dd($tasks)--}}
                                {{--<div class="row" style="border-bottom: 1px solid #DEDEDE;">--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Имя--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Компания--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-3">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Описание--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Менеджер--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Сроки--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Статус выполнения--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--@foreach($tasks as $task)--}}
                                    {{--@if($task->status_id != 1 && \App\User::find($task->user_id)->role != 'admin' && $task->user_id == $user->id)--}}
                                        {{--@include('pages.Meets.includes.meet_admin')--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                                                {{--</li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                        {{--<div class="tab-pane fade" id="meet-done-{{ $user->id }}" role="tabpanel" aria-labelledby="home-tab">--}}
                                            {{--<div class="tab-content" id="myTabContent">--}}
                                                {{--<ul class="nav nav-tabs" id="myTab" role="tablist">--}}
                                                    {{--<li class="nav-item col-15 pl-0 pr-3">--}}

                                {{--<p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">--}}
                                    {{--Завершенные встречи--}}
                                {{--</p>--}}
                                {{--<div class="row" style="border-bottom: 1px solid #DEDEDE;">--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Имя--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Компания--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-3">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Описание--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Менеджер--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Сроки--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}
                                        {{--<p class="title-task">--}}
                                            {{--Статус выполнения--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-2">--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="content-tasker" id="content-tasker">--}}
                                    {{--@foreach($tasks as $task)--}}
                                        {{--@if($task->status_id == 1 && \App\User::find($task->user_id)->role != 'admin' && $task->user_id == $user->id)--}}
                                            {{--@include('pages.Meets.includes.done_meet_admin')--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>  --}}

        @endsection
        @foreach($tasks as $task)
            @include('modals.meets.done_meet_admin')
            @include('modals.meets.edit_meet_admin')
            @include('modals.meets.delete_meet_admin')
        @endforeach

        @push('scripts')
            <script>
                $('.doneMeet').click(e => {
                    e.preventDefault();
                    let btn = $(e.currentTarget);
                    let user = btn.data('parent');
                    let id = btn.data('id');

                    // console.log(id);
                    $.ajax({
                        url: 'DoneMeetAdmin',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: data => {
                            $('#DoneMeetAdmin-' + id).modal('hide');
                            $('#task-now').find('.meet-' + data.data.id).hide(200);
                            let result = $('#done_task_content').append(data.view).show('slide',{direction: 'left'}, 400);
                            $('#task-now-' + user).find('.meet-' + data.data.id).hide(200);
                            $('#done_task-' + data.data.user_id).append(data.view).show('slide', {direction: 'left'}, 400);

                            swal("Встреча завершена!","","success");
                        },
                        error: () => {
                            console.log(0);
                            swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                        }
                    })
                })
            </script>
            <script>
                $('.deleteMeet').click(e => {
                    e.preventDefault();
                    let btn = $(e.currentTarget);
                    let id = btn.data('id');
                    let user = btn.data('parent');


                    console.log(id);
                    $.ajax({
                        url: 'DeleteMeetAdmin',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: data => {
                            if(data.data.status_id == 0)
                            {
                                $('#task-now-' + user).find('.meet-' + data.data.id).hide(200);
                                $('#task-now').find('.meet-' + data.data.id).hide(200);
                            }
                            else if(data.data.status_id == 1)
                            {
                                $('#task-done-' + user).find('.donemeet-' + data.data.id).hide(200);
                                $('#task-done').find('.donemeet-' + data.data.id).hide(200);
                            }
                            swal("Задача удалена!","","success");
                            // $('#meet-' + id).hide(200);
                            $('#DeleteMeetAdmin-' + id).modal('hide');
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
                $('.editMeet').click(e => {
                    e.preventDefault();
                    let btn = $(e.currentTarget);
                    let id = btn.data('id');
                    let user = btn.data('parent');
                    let desc = $('#meet_desc-' + id);
                    let date = $('#meet_date-' + id);
                    let manage = $('#meet_manage-' + id);
                    if(desc.val() == '')
                    {
                        swal("Заполните описание!","Поле описание стало обязательным","error");
                    }
                    else {
                        // console.log(id);
                        $.ajax({
                            url: 'EditMeetAdmin',
                            method: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "desc": desc.val(),
                                "date": date.val(),
                                "manage": manage.val(),
                                "id": id,
                            },
                            success: data => {
                                $('#EditMeetAdmin-' + id).modal('hide');
                                swal("Встреча изменена!", "", "success");
                                if(data.data.user_id == user) {
                                    if (data.data.status_id == 0)
                                    {
                                        $('#task-now').find('.meet-' + data.data.id).find('.meet-desc').html(data.data.description);
                                        $('#task-now').find('.meet-' + data.data.id).find('.meet-date').html(data.data.deadline_date);
                                        $('#task-now-' + user).find('.meet-' + data.data.id).find('.meet-desc').html(data.data.description);
                                        $('#task-now-' + user).find('.meet-' + data.data.id).find('.meet-date').html(data.data.deadline_date);
                                    }
                                    else if(data.data.status_id == 1)
                                    {
                                        $('#task-done').find('.donemeet-' + data.data.id).find('.meet-desc').html(data.data.description);
                                        $('#task-done').find('.donemeet-' + data.data.id).find('.meet-date').html(data.data.deadline_date);
                                        $('#task-done-' + user).find('.donemeet-' + data.data.id).find('.meet-desc').html(data.data.description);
                                        $('#task-done-' + user).find('.donemeet-' + data.data.id).find('.meet-date').html(data.data.deadline_date);
                                    }
                                }
                                else
                                {
                                    if(data.data.status_id == 0)
                                    {
                                        $('#EditMeetAdmin-' + id).modal('hide');
                                        $('#task-now-' + user).find('.meet-' + data.data.id).hide(200);
                                        let result = $('#task_content-' + data.data.user_id).append(data.view).show('slide',{direction: 'left'}, 400);
                                        $('#task-now').find('.meet-' + data.data.id).find('.meet-desc').html(data.data.description);
                                        $('#task-now').find('.meet-' + data.data.id).find('.meet-date').html(data.data.deadline_date);
                                        $('#task-now').find('.meet-' + data.data.id).find('.meet-manager').html(data.user);
                                    }
                                    else if(data.data.status_id == 1)
                                    {
                                        $('#EditMeetAdmin-' + id).modal('hide');
                                        $('#task-done-' + user).find('.donemeet-' + data.data.id).hide(200);
                                        let result = $('#done_task-' + data.data.user_id).append(data.view).show('slide',{direction: 'left'}, 400);
                                        $('#task-done').find('.donemeet-' + data.data.id).find('.meet-desc').html(data.data.description);
                                        $('#task-done').find('.donemeet-' + data.data.id).find('.meet-date').html(data.data.deadline_date);
                                        $('#task-done').find('.donemeet-' + data.data.id).find('.meet-manager').html(data.user);
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
    @endpush