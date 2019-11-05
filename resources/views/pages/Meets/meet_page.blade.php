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
            Встречи
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
        @foreach($tasks as $task)
            @if($task->status_id != 1 && \App\User::find($task->user_id)->role != 'admin')
                @include('pages.Meets.includes.meet')
            @endif
        @endforeach

        <p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">
            Завершенные встречи
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
        <div class="content-tasker" id="content-tasker">
            @foreach($tasks as $task)
                @if($task->status_id == 1 && \App\User::find($task->user_id)->role != 'admin')
                    @include('pages.Meets.includes.done_meet')
                @endif
            @endforeach
        </div>
    </div>

@endsection
@foreach($tasks as $task)
    @include('modals.tasks.done_task')
@endforeach

@push('scripts')
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
                        $('#DoneTask-' + id).modal('hide');
                        swal("Задача выполнена!","Отчет был отправлен","success");
                        // console.log(data.view);
                        let result = $('#content-tasker').append(data.view).show('slide', {direction: 'left'}, 400);
                    },
                    error: () => {
                        console.log(0);
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                    }
                })
            }


        })
    </script>
@endpush