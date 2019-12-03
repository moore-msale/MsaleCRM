@extends('layouts.app')

@section('content')
    @include('_partials.header')
    <div class="mt-5 pt-4">
        <div class="mt-2 mx-lg-3 mx-0 py-2 d-flex justify-content-center">
            <p class="text-dark sf-bold mb-0 mr-2 w-25" style="font-size: 18px;font-weight: 600;">
                Задачи
            </p>
            @if(auth()->user()->role=='admin')
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateTaskAdmin"  style="text-decoration: underline;font-size:14px;">
                    добавить задачу
                </a>
            @else
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateTask"  style="text-decoration: underline;font-size:14px;">
                    добавить задачу
                </a>
            @endif
        </div>
    </div>
    <div >
        <div class="blog-scroll" id="tasks-scroll">
            @include('tasks.list', ['tasks3' => $tasks])
        </div>
    </div>
    @if(auth()->user()->role=='admin')
        @include('modals.tasks.create_task_admin')
    @else
        @include('modals.tasks.create_task')
    @endif
@endsection
@push('scripts')
    <script>
        $(document).on('click','.editTask', e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let user = btn.data('parent');
            let title = $('#task_name-' + id);
            let desc = $('#task_desc-' + id);
            let date = $('#task_date-' + id);
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
                            $('#EditTask-' + id).find('.modal-title').html(data.task.title);
                            $('#task-' + id).find('.task-name').html(data.task.title);
                            $('#task-' + id).find('.task-deadline').html(data.deadline_date);
                            if (data.task.description.length > 25)
                                $('#task-' + id).find('.task-desc').html(data.task.description.substring(0,25) + '...');
                            else
                                $('#task-' + id).find('.task-desc').html(data.task.description);
                            // if(data.status_id){
                            //     $('#task-' + id).find('.status-task').css("background-color",data.status_id.color);
                            //     $('#task-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                            // }else{
                            //     $('#task-' + id).find('.status-task').css("background-color",'#C4C4C4');
                            //     $('#task-' + id).find('.change-color').attr('fill','#C4C4C4').css("color",'#C4C4C4');
                            // }
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
        $(document).on("click", '.doneTask',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
            let user = btn.data('parent');
            let id = btn.data('id');

            // console.log(id);
            $.ajax({
                url: '{{route('taskdone')}}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: data => {
                    if(data.status=='success'){
                        $('#EditTask-' + id).modal('hide');
                        $('#task-' + id).find('.status-task').css("background-color", "#26DB38");
                        $('#task-' + id).find('.change-color').attr('fill',"rgb(38, 219, 56)").css("color","#26DB38");
                        $('#task-' + id).find('.task-status button').html(data.status_id.name).css("background-color","#26DB38");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Задача выполнена!\nОтчет был отправлен',
                            showConfirmButton: false,
                            timer: 700
                        });
                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Задача уже завершена!',
                            showConfirmButton: false,
                            timer: 700
                        });
                    }
                },
                error: () => {
                    console.log(0);
                    swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                }
            })
        })
    </script>
    <script>
        $(document).on("click", '.deleteTask',function( event ) {
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
        $(document).on("click", '.editTaskAdmin',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
            let id = btn.data('id');
            let user = btn.data('parent');
            let title = $('#task_name_admin-' + id);
            let desc = $('#task_desc_admin-' + id);
            let date = $('#task_date_admin-' + id);
            let manage = $('#task_manager_admin-' + id);
            let status = $('#task_status_admin-' + id);
            if(desc.val() == '')
            {
                swal("Заполните описание!","Поле описание стало обязательным","error");
            }
            else {
                $.ajax({
                    url: 'EditTaskAdmin',
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
                        if(data.status == 'success'){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Данные изменены!',
                                showConfirmButton: false,
                                timer: 700
                            });
                            console.log(data);
                            $('#EditTaskAdmin-' + id).find('.modal-title').html(data.task.title);
                            $('#task-' + id).find('.task-name').html(data.task.title);
                            $('#task-' + id).find('.task-deadline').html(data.deadline_date);
                            $('#task-' + id).find('.task-manager').html(data.user);
                            if (data.task.description.length > 25)
                                $('#task-' + id).find('.task-desc').html(data.task.description.substring(0,25) + '...');
                            else
                                $('#task-' + id).find('.task-desc').html(data.task.description);

                            if(data.status_id){
                                $('#task-' + id).find('.status-task').css("background-color",data.status_id.color);
                                $('#task-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                            }else{
                                $('#task-' + id).find('.status-task').css("background-color",'#C4C4C4');
                                $('#task-' + id).find('.change-color').attr('fill','#C4C4C4').css("color",'#C4C4C4');
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
@endpush
