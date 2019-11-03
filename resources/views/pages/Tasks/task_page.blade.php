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
        <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
            Задачи
        </p>
        {{--@dd($tasks)--}}
        <div class="row" style="border-bottom: 1px solid #DEDEDE;">
            <div class="col-6">
                <p class="title-task">
                    Наименование задачи
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
        @foreach($tasks as $task)
            @if($task->status_id != 1 && \App\User::find($task->user_id)->role != 'admin')
            <div class="row py-2 task-point">
                <div class="col-6 d-flex align-items-center">
                    <span class="task-name">
                        {{$task->description}}
                    </span>
                </div>
                <div class="col-2 d-flex align-items-center">
                    <span class="task-name">
                        {{ \App\User::find($task->user_id)->name }}
                    </span>
                </div>
                <div class="col-2 d-flex align-items-center">
                    <span class="task-name">
                        {{ $task->deadline_date }}
                    </span>
                </div>
                <div class="col-2 text-center">
                        @if($task->status_id == 0)
                            <button class="btn py-2 px-3 task-name task-button text-white" style="background:#A8A8A8; opacity: 1;" disabled>
                                Не выполнено
                            </button>
                        @else
                        <button class="btn py-2 px-3 task-name task-button text-white" style="background:#3BD654; opacity: 1;" disabled>
                            Выполнено
                        </button>
                        @endif
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center">
                        <i class="far fa-check-circle fa-sm mr-3 ico-done task-ico" data-toggle="modal" data-target="#DoneTask-{{$task->id}}" title="Завершить задачу"></i>
                        <i class="far fa-times-circle fa-sm mr-3 ico-delete task-ico" title="Удалить задачу"></i>
                        <i class="far fa-calendar fa-sm mr-3 ico-update task-ico" title="Изменить дату"></i>
                        <i class="fas fa-pencil-alt fa-sm mr-3 ico-edit task-ico" title="Изменить описание"></i>
                </div>
            </div>
            @endif
        @endforeach

        <p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">
            Выполненные задачи
        </p>
        <div class="row" style="border-bottom: 1px solid #DEDEDE;">
            <div class="col-6">
                <p class="title-task">
                    Наименование задачи
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
        @foreach($tasks as $task)
            @if($task->status_id == 1 && \App\User::find($task->user_id)->role != 'admin')
                <div class="row py-2 task-point">
                    <div class="col-6 d-flex align-items-center">
                    <span class="task-name">
                        {{$task->description}}
                    </span>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                    <span class="task-name">
                        {{ \App\User::find($task->user_id)->name }}
                    </span>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                    <span class="task-name">
                        {{ $task->deadline_date }}
                    </span>
                    </div>
                    <div class="col-2 text-center">
                        @if($task->status_id == 0)
                            <button class="btn py-2 px-3 task-name task-button text-white" style="background:#A8A8A8; opacity: 1;" disabled>
                                Не выполнено
                            </button>
                        @else
                            <button class="btn py-2 px-3 task-name task-button text-white" style="background:#3BD654; opacity: 1;" disabled>
                                Выполнено
                            </button>
                        @endif
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        {{--<i class="far fa-check-circle fa-sm mr-3 ico-done task-ico" data-toggle="modal" data-target="#DoneTask-{{$task->id}}" title="Завершить задачу"></i>--}}
                        <i class="far fa-times-circle fa-sm mr-3 ico-delete task-ico" title="Удалить задачу"></i>
                        {{--<i class="far fa-calendar fa-sm mr-3 ico-update task-ico" title="Изменить дату"></i>--}}
                        {{--<i class="fas fa-pencil-alt fa-sm mr-3 ico-edit task-ico" title="Изменить описание"></i>--}}
                    </div>
                </div>
            @endif
        @endforeach
    </div>

@endsection
@foreach($tasks as $task)
    @include('modals.done_task')
@endforeach