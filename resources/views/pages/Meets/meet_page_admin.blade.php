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
                <form class="row" action="{{ route('meet_filter')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="col-2">
                        <select name="manager" id="meetingname" class="browser-default custom-select border-0 rounded-0  p-0 pl-4" style="height: 31px;">
                             <option value="{{isset($manager) ? $manager : null }}">{{ isset($manager) ? \App\User::find($manager)->name. ' - ' .\App\User::find($manager)->lastname : 'Все менеджеры'}}</option>
                            @if(isset($manager))
                                <option value="{{ null }}">Все менеджеры</option>
                            @endif
                             @foreach(\App\User::all() as $user)
                                 @if(isset($manager) && $user->id == $manager)
                                    @continue
                                 @endif
                                 <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->lastname }}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <select name="status" id="meetingname" class="browser-default custom-select border-0 rounded-0  p-0 pl-4" style="height: 31px;">
                            @if(isset($status) && $status == 0)
                                <option value="0">Без встреч</option>
                            @else
                            <option value="{{isset($status) ? $status : null }}">{{ isset($status) ? \App\Status::find($status)->name : 'Все встречи'}}</option>
                                <option value="0">Без встреч</option>
                            @endif
                            @if(isset($status) )
                                <option value="{{ null }}">Все встречи</option>
                            @endif

                            @foreach(\App\Status::where('type','meet')->get() as $status1)
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
                        <span class="button-create mr-3" data-toggle="modal" data-target="#CreateClientAdmin" style="color:#000000;">
                            + добавить клиента
                        </span>
                        <span class="button-create mr-3" data-toggle="modal" data-target="#CreateTaskAdmin" style="color:#000000;">
                            + добавить задачу
                        </span>
                        <span class="button-create" style="color:#000000;" data-toggle="modal" data-target="#CreateMeetAdmin">
                            + добавить встречу
                        </span>
                    </div>
                </form>
            <div class="row pt-4">
                <div class="col-6">
                    <div class="search">
                        <input id="search" class="form-control" style="height:55px;padding-left:2.5rem;background-image:url('{{asset('images/zoom-2 1.svg')}}');background-repeat: no-repeat;background-position: 2% 50%;" type="text" placeholder="Поиск среди задач">
                        <div class="position-relative">
                            <div class="position-absolute search-result bg-white mt-2" id="search-result" style="right: 0; top: 160%;width:100%; z-index:999;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="content-block pt-4" style="height:40vh;">
            <h2 class="pb-3">Встречи</h2>
            <div class="row mb-3 py-2 sf-light" id="meets-content" style="border-bottom:1px solid #DEDEDE; color:#a8a8a8;">
                <div class="col-2 pr-0">
                    Компания
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
                <div class="col-2 text-center">
                    Статус
                </div>

                <div class="col-2">
                    Дата создания
                </div>
                <div class="col-3">

                </div>
            </div>

             @foreach($tasks as $task)
                <div class="row py-2 my-1 sf-light position-relative  rows-hover" id="meet-{{$task->id}}">
                     <div class="col-2 meet-name-admin" style="border-right:1px solid #dedede; white-space: nowrap;">
                         {{ $task->title }}
                     </div>
                     <div class="col-4 meet-desc-admin" style="border-right:1px solid #dedede; white-space: nowrap;">
                         {{ str_limit($task->description, $limit = 25, $end = '...') }}
                     </div>
                     <div class="col-2 meet-manager-admin" style="border-right:1px solid #dedede;">
                         {{ \App\User::find($task->user_id)['name'] }}
                     </div>
                     <div class="col-2 meet-deadline-admin">
                         {{ \Carbon\Carbon::parse($task->deadline_date)->format('M d - H:i') }}
                     </div>
                     <div class="col-2 meet-status-admin">
                         @if($task->active==2)
                             <button style="width:100%; height:100%; color:white; background: #26DB38; border-radius: 20px; border:0px;" disabled>
                                 Завершено
                             </button>
                         @elseif(!$task->active)
                             <button style="width:100%; height:100%; color:white; background: #DA2121; border-radius: 20px; border:0px;" disabled>
                                 Просроченно
                             </button>
                         @elseif(isset($task->status))
                            <button style="width:100%; height:100%; color:white; background: {{ $task->status->color }}; border-radius: 20px; border:0px;" disabled>
                                 {{ $task->status['name'] }}
                             </button>
                         @else
                             <button style="width:100%; height:100%; color:white; background: #EBDC60; border-radius: 20px; border:0px;" disabled>
                                 В ожидании
                             </button>
                         @endif
                     </div>
                     <div class="col-2 meet-date-admin">
                         {{ \Carbon\Carbon::parse($task->created_at)->format('M d - H:i') }}
                     </div>
                     <div class="btn-group dropleft col-1">
                         <i class="fas fa-ellipsis-v w-100" data-toggle="dropdown" style="color:#C4C4C4; cursor: pointer;"></i>
                         <div class="dropdown-menu pl-2" style="border-radius: 0px; border:none;">
                             <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#EditMeetAdmin-{{$task->id}}" style="cursor:pointer;">изменить</p>
                             <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#DeleteMeetAdmin-{{$task->id}}" style="cursor:pointer;">неудачно</p>
                         </div>
                     </div>
                </div>
                @endforeach
            </div>
        </div>
@foreach($tasks as $task)
    @include('modals.meets.done_meet_admin')
    @include('modals.meets.delete_meet_admin')
    @include('modals.meets.edit_meet_admin')
    @include('modals.meets.search_meet_modal')
@endforeach

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
                    url: '{!! route('search_meet') !!}',
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
        $(document).on("click", '.deleteMeet',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
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
                            title: 'Встреча удалена!',
                            showConfirmButton: false,
                            timer: 700
                        });
                        $('#meet-' + id).hide();
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
        $(document).on("click", '.editMeetAdmin',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
            let id = btn.data('id');
            let user = btn.data('parent');
            let title = $('#meet_name-' + id);
            let desc = $('#meet_desc-' + id);
            let date = $('#meet_date-' + id);
            let manage = $('#meet_manager-' + id);
            let status = $('#meet_status-' + id);
            if(date.val()==''){
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Дата просрочена выберите дату',
                    showConfirmButton: true,
                    // timer: 700
                });
            }
            else if(desc.val().length < 20)
            {
                swal("Заполните описание!","Поле описание стало обязательным","error");
            }
            else {
                    $.ajax({
                        url: 'EditMeetAdmin',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "title": title.val(),
                            "desc": desc.val(),
                            "date": date.val(),
                            "manage": manage.val(),
                            "status": status.val(),
                            "id": id,
                        },
                        success: data => {
                            if(data.status == "success") {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Данные изменены!',
                                    showConfirmButton: false,
                                    timer: 700
                                });
                                console.log(data);
                                $('#EditMeetAdmin-' + id).modal('hide');
                                $('#meet-' + id).find('.meet-name-admin').html(data.meet.title);
                                $('#meet-' + id).find('.meet-deadline-admin').html(data.deadline_date);
                                $('#meet-' + id).find('.meet-manager-admin').html(data.user);
                                if (data.meet.description.length > 25)
                                    $('#meet-' + id).find('.meet-desc-admin').html(data.meet.description.substring(0, 25) + '...');
                                else
                                    $('#meet-' + id).find('.meet-desc-admin').html(data.meet.description);
                                if(data.meet.active==2){
                                    $('#meet-' + id).find('.meet-status-admin button').html('Завершено').css("background-color",'#26DB38');
                                }else if(data.status_id && data.meet.active == 1){
                                    $('#meet-' + id).find('.meet-status-admin button').html(data.status_id.name).css("background-color",data.status_id.color);
                                }else{
                                    $('#meet-' + id).find('.meet-status-admin button').html('В ожидании').css("background-color",'#EBDC60');
                                }
                            } else{
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

        $(document).click(function(event) {
            if (!$(event.target).is("#search, #search-result, #search-result-ajax, .collapse, .products")) {
                $("#search-result").parent().slideUp(400);
            }
        });
    </script>
@endpush
