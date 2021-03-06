@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }
        .nav-link.active{
            background: #FFFFFF!important;
            color: #000!important;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
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
                <div class="row">
                    @include('_partials.header')
                    @include('tasks.index', ['calls2' => $calls,'wcalls'=>$wcalls])
                    @include('tasks.index', ['tasks2' => $tasks])
                    @include('tasks.index', ['meetings2' => $meetings])
                    @include('tasks.index', ['customers2' => $customers])
                </div>
            @else
                <div class="row pt-lg-4 pt-0 justify-content-center">
                @if(\Illuminate\Support\Facades\Auth::user()->role == "admin")
                    @include('tasks.statistics-admin')
                @else
                    @include('tasks.statistics')
                @endif
                    @include('tasks.index', ['tasks2' => $tasks])
                    @include('tasks.index', ['meetings2' => $meetings])
                    @include('tasks.index', ['customers2' => $customers])
                    @include('tasks.index', ['calls2' => $calls])
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
    @elseif(auth()->user()->role=='admin')
        @include('modals.tasks.create_task_admin')
        @include('modals.calls.create_call')
        @include('modals.meets.create_meet_admin')
        @include('modals.calls.called-modal')
        @include('modals.customers.add_customer')
        @include('modals.customers.add_potencial')
        @include('modals.customers.create_client_admin')
    @else
        @include('modals.calls.create_call')
        @include('modals.calls.called-modal')
        @include('modals.customers.add_customer')
        @include('modals.customers.add_potencial')
    @endif
@endsection

@push('scripts')
    <script>
        $('.nav-link').on('click', e=>{
            $('.nav-link').removeClass('active');
            let page = $(e.currentTarget);
            if(page.data('parent')=='waitCalls'){
                $('.cleared').attr('href','clearWCall');
            }else{
                $('.cleared').attr('href','clearCall');
            }
        });
    </script>
    <script>
        $(document).on('click','.haveAccount',e=>{
            if($(e.currentTarget).attr('href')=='#register'){
                $('.log').addClass('active');
            }else{
                $('.reg').addClass('active');
            }
        })
    </script>
    {{--<script>--}}
        {{--$('.stats-score2').click( function () {--}}
            {{--Swal.fire({--}}
                {{--position: 'top-end',--}}
                {{--icon: 'success',--}}
                {{--title: 'Изменения сохранены',--}}
                {{--showConfirmButton: false,--}}
                {{--timer: 700--}}
            {{--})--}}
        {{--});--}}
    {{--</script>--}}
    <script>
        $(document).on('click','.home-search',function (e) {
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            $.ajax({
                url: '/findCustomer/'+id,
                method:'GET',
                success: (data) => {
                    $('body').append(data.view);
                    $(''+data.modal+id).modal('show');
                },
                error: () => {
                    console.log('error');
                }
            });
        })
    </script>
    <script>
        $(document).on('click','.deleteCallDesktop',e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            console.log(id);
            $.ajax({
                url: 'calldelete',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: data => {
                    $('#call-' + id).hide(5);
                },
                error: () => {
                    console.log(0);
                    swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                }
            })


        });
    </script>
    <script>
        $(document).on("click", '.editMeet',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
            let id = btn.data('id');
            let user = btn.data('parent');
            let customer = $('#meet_name-' + id);
            let desc = $('#meet_desc-' + id);
            let date = $('#meet_date-' + id);
            let status = $('#meet_status-' + id);

            if(desc.val().length < 20)
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
                    url: 'meeting/'+id,
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "customer": customer.val(),
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
                            $('#meet-' + id).find('.meet-deadline').html(data.deadline_date);
                            $('#meet-' + id).find('.meet-manager').html(data.user);
                            $('#meet-' + id).find('.meet-date1').html(data.date1);
                            $('#meet-' + id).find('.meet-date2').html(data.date2);
                            if(data.customer){
                                $('#meet-' + id).find('.meet-name').html(data.customer.name);
                            }
                            if (data.meet.description.length > 25)
                                $('#meet-' + id).find('.meet-desc').html(data.meet.description.substring(0,25) + '...');
                            else
                                $('#meet-' + id).find('.meet-desc').html(data.meet.description);

                            if(data.meet.active==2){
                                $('#meet-' + id).find('.meet-status button').html('Завершено').css("background-color",'#26DB38');
                                $('#meet-' + id).find('.status-meet').css("background-color",'#26DB38');
                                $('#meet-' + id).find('.change-color').attr('fill','#26DB38').css("color",'#26DB38');
                            }else if(data.status_id && data.meet.active == 1){
                                $('#meet-' + id).find('.meet-status button').html(data.status_id.name).css("background-color",data.status_id.color);
                                $('#meet-' + id).find('.status-meet').css("background-color",data.status_id.color);
                                $('#meet-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                            }else{
                                $('#meet-' + id).find('.meet-status button').html('В ожидании').css("background-color",'#EBDC60');
                                $('#meet-' + id).find('.status-meet').css("background-color",'#C4C4C4');
                                $('#meet-' + id).find('.change-color').attr('fill','#C4C4C4').css("color",'#C4C4C4');
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
        $(document).on('click','.createclient',function () {

            let id = $('.caller_id').val();
            let company = $('.caller_company').val();
            let phone = $('.caller_phone').val();
            $('#client_company1').val(company);
            $('#client_contacts1').val(phone);
            $('#call_id1').val(id);
            $('#client_company_admin').val(company);
            $('#client_contacts_admin').val(phone);
            $('#call_id_admin').val(id);
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
{{--    <script>--}}
{{--        $(document).on("click", '.editMeetAdmin',function( event ) {--}}
{{--            event.preventDefault();--}}
{{--            let btn = $(event.currentTarget);--}}
{{--            let id = btn.data('id');--}}
{{--            let user = btn.data('parent');--}}
{{--            let title = $('#meet_name_admin-' + id);--}}
{{--            let desc = $('#meet_desc_admin-' + id);--}}
{{--            let date = $('#meet_date_admin-' + id);--}}
{{--            let manage = $('#meet_manager_admin-' + id);--}}
{{--            let status = $('#meet_status_admin-' + id);--}}
{{--            if(desc.val() == '')--}}
{{--            {--}}
{{--                swal("Заполните описание!","Поле описание стало обязательным","error");--}}
{{--            }--}}
{{--            else {--}}
{{--                $.ajax({--}}
{{--                    url: 'EditMeetAdmin',--}}
{{--                    method: 'POST',--}}
{{--                    data: {--}}
{{--                        "_token": "{{ csrf_token() }}",--}}
{{--                        "customer": title.val(),--}}
{{--                        "desc": desc.val(),--}}
{{--                        "date": date.val(),--}}
{{--                        "manage": manage.val(),--}}
{{--                        "status": status.val(),--}}
{{--                        "id": id,--}}
{{--                    },--}}
{{--                    success: data => {--}}
{{--                        if(data.status == "success"){--}}
{{--                            Swal.fire({--}}
{{--                                position: 'top-end',--}}
{{--                                icon: 'success',--}}
{{--                                title: 'Данные изменены!',--}}
{{--                                showConfirmButton: false,--}}
{{--                                timer: 700--}}
{{--                            });--}}
{{--                            console.log(data);--}}
{{--                            $('#meet-' + id).find('.meet-name').html(data.meet.title);--}}
{{--                            $('#meet-' + id).find('.meet-manager').html(data.user);--}}
{{--                            $('#meet-' + id).find('.meet-desc').html(data.meet.description);--}}
{{--                            $('#meet-' + id).find('.meet-date1').html(data.date1);--}}
{{--                            $('#meet-' + id).find('.meet-date2').html(data.date2);--}}
{{--                            if(data.meet.active == 2){--}}
{{--                                $('#meet-' + id).find('.meet-status button').html('Завершено').css("background-color",'#26DB38');--}}
{{--                                $('#meet-' + id).find('.status-meet').css("background-color",'#26DB38');--}}
{{--                                $('#meet-' + id).find('.change-color').attr('fill','#26DB38').css("color",'#26DB38');--}}
{{--                            }else if(data.status_id && data.meet.active == 1){--}}
{{--                                $('#meet-' + id).find('.meet-status button').html(data.status_id.name).css("background-color",data.status_id.color);--}}
{{--                                $('#meet-' + id).find('.status-meet').css("background-color",data.status_id.color);--}}
{{--                                $('#meet-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);--}}
{{--                            }else{--}}
{{--                                $('#meet-' + id).find('.meet-status button').html('В ожидании').css("background-color",'#EBDC60');--}}
{{--                                $('#meet-' + id).find('.status-meet').css("background-color",'#C4C4C4');--}}
{{--                                $('#meet-' + id).find('.change-color').attr('fill','#C4C4C4').css("color",'#C4C4C4');--}}
{{--                            }--}}
{{--                        } else{--}}
{{--                            Swal.fire({--}}
{{--                                position: 'top-end',--}}
{{--                                icon: 'info',--}}
{{--                                title: 'Изменение не найдены!',--}}
{{--                                showConfirmButton: false,--}}
{{--                                timer: 700--}}
{{--                            });--}}
{{--                            console.log(data);--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: () => {--}}
{{--                        console.log(0);--}}
{{--                        Swal.fire({--}}
{{--                            position: 'top-end',--}}
{{--                            icon: 'error',--}}
{{--                            title: 'Что-то пошло не так!',--}}
{{--                            showConfirmButton: false,--}}
{{--                            timer: 700--}}
{{--                        });--}}
{{--                    }--}}
{{--                })--}}
{{--            }--}}
{{--        })--}}
{{--    </script>--}}
    <script>
        $(document).on("click", '.doneTaskAdmin',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
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
                            $('#EditTask-' + id).find('.modal-title').html(data.task.title);
                            $('#task-' + id).find('.task-name').html(data.task.title);
                            $('#task-' + id).find('.task-date1').html(data.date1);
                            $('#task-' + id).find('.task-date2').html(data.date2);
                            $('#task-' + id).find('.task-manager').html(data.user);
                            $('#task-' + id).find('.task-desc').html(data.task.description);

                            if(data.status_id){
                                $('#task-' + id).find('.task-status button').html(data.status_id.name).css("background-color",data.status_id.color);
                                $('#task-' + id).find('.status-task').css("background-color",data.status_id.color);
                                $('#task-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                            }else{
                                $('#task-' + id).find('.task-status button').html('В работе').css("background-color",'#3B79D6');
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
    <script>
        $(document).on("click", '.deleteCustomer',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
            let id = btn.data('id');
            $.ajax({
                url: 'DeleteCustomerAdmin',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: data => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Клиент удален!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    $('#DeleteCustomerAdmin-' + id).modal('hide');
                    $('#customer-' + id).remove();
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

        })
    </script>
    <script>
        $(document).on("click", '.editCustomer',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
            let id = btn.data('id');
            let date = $('#client_date-' + id);
            let name = $('#client_name-' + id);
            let company = $('#client_company-' + id);
            let phone = $('#client_phone-' + id);
            let social = $('#client_social-' + id);
            let manager = $('#client_manager-' + id);
            let status = $('#client_status-' + id);
            let desc = $('#client_desc-' + id);
            if(!date.val()){
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Дата просрочена выберите новую!',
                    showConfirmButton: true,
                    // timer: 700
                });
            }
            else if(desc.val().length < 20)
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
                    url: '{{route('customerupdate')}}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "date": date.val(),
                        "name": name.val(),
                        "company": company.val(),
                        "phone": phone.val(),
                        "social": social.val(),
                        "manager": manager.val(),
                        "status": status.val(),
                        "desc": desc.val(),
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
                            $('#customer-' + id).find('.cust-name').html(data.customer.name);
                            $('#customer-' + id).find('.cust-company').html(data.customer.company);
                            $('#customer-' + id).find('.cust-date1').html(data.date1);
                            $('#customer-' + id).find('.cust-date2').html(data.date2);
                            $('#history_block-' + id).html(data.html);
                            console.log(data);
                            if(data.status_id){
                                $('#customer-' + id).find('.status-customer').css("background-color",data.status_id.color);
                                $('#customer-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                            }else{
                                $('#customer-' + id).find('.status-customer').css("background-color",'#C4C4C4');
                                $('#customer-' + id).find('.change-color').attr('fill','#C4C4C4').css("color",'#C4C4C4');

                            }
                            console.log(data);
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
        $(document).on("click", '.addTask2',function( event ) {
            event.preventDefault();
            let btn = $(event.currentTarget);
            let title = $('#taskname2');
            let desc = $('#taskdescription2');
            let date = $('#taskdate2');
            let user = $('#taskuser2');
            let chief = 1;

            $.ajax({
                url: '{{ route('task.store') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "title": title.val(),
                    "description": desc.val(),
                    "deadline_date": date.val(),
                    "user_id": user.val(),
                    "chief": chief,
                },
                success: data => {
                    $('#TaskCreate_admin').modal('hide');
                    swal("Задача добавлена!","Отчет был отправлен","success");
                    $('#taskname2').val('');
                    $('#taskdescription2').val('');
                    $('#taskdate2').val('');
                    $('#taskuser2').val('');

                },
                error: () => {
                    console.log(0);
                    swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                }
            })
        })
    </script>
    @if($agent->isPhone())

        <script>
            // $(document).on('click','.call-btn',function (event){
            //         let btn = $(event.currentTarget);
            //         let id = btn.data('id');
            //         let company = btn.data('parent');
            //         let phone = btn.data('parent2');
            //         $('#calledModal').modal('show');
            //         $('#caller_id').val(id);
            //         $('#caller_company').val(company);
            //         $('#caller_phone').val(phone);
            //     })
            // });
            function registerCallBtn(item) {
                item.click(function (e) {
                    e.preventDefault();
                    let btn = $(e.currentTarget);
                    let id = btn.data('id');
                    let company = btn.data('parent');
                    let phone = btn.data('parent2');
                    let active = btn.data('parent3');
                    if(active){
                        $('.waitCall').removeClass('d-flex');
                        $('.waitCall').addClass('d-none');
                    }else{
                        $('.waitCall').removeClass('d-none');
                        $('.waitCall').addClass('d-flex');
                    }
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
                        $('#calls-scroll').html('');
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
            $(document).on("click", '.addClient',function( event ) {
                event.preventDefault();
                let btn = $(event.currentTarget);
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
            $(document).on("click", '.Call_1_add',function( event ) {
                event.preventDefault();
                let btn = $(event.currentTarget);
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
                        let result = $('#calls-scroll').prepend(data.view).show('slide', {direction: 'left'}, 400);
                        $('#call_company').val('');
                        $('#call_number').val('');
                        console.log('somethings');
                        result.find('.call-btn').each((e, i) => {
                        registerCallBtn($(i));
                        });
                        Swal.fire({
                            position: 'top-start',
                            icon: 'success',
                            title: 'Номер добавлен!',
                            showConfirmButton: false,
                            timer: 700
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
            $(document).on('click','.waitCall',e => {
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
                        Swal.fire({
                            position: 'top-start',
                            icon: 'success',
                            title: 'Звонок добавлен в список на перезвон!',
                            showConfirmButton: false,
                            timer: 700
                        });
                        $('#calledModal').modal('hide');
                        let result = $('#wcalls-scroll').prepend(data.view).show('slide', {direction: 'left'}, 400);
                        result.find('.call-btn').each((e, i) => {
                            registerCallBtn($(i));
                        });
                        $('#call-' + id).hide(400);
                        console.log(data);
                    },
                    error: () => {
                        console.log(0);
                        swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                    }
                })
            })
            registerCallBtn($('.call-btn'));
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
                        url: '{!! route('search_customer') !!}',
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
            $(document).on("click", '.call_add',function( event ) {
                event.preventDefault();
                let btn = $(event.currentTarget);
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
            $(document).on("click", '.addCall',function( event ) {
                event.preventDefault();
                let btn = $(event.currentTarget);
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
                        $('#calls-scroll').html('');
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
            $(document).on("click", '.editTask',function( event ) {
                event.preventDefault();
                let btn = $(event.currentTarget);
                let id = btn.data('id');
                let user = btn.data('parent');
                let title = $('#task_name-' + id);
                let desc = $('#task_desc-' + id);
                let date = $('#task_date-' + id);
                let manage = $('#task_manager-' + id);
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
                                $('#EditTask-' + id).find('.modal-title').html(data.task.title);
                                $('#task-' + id).find('.task-name').html(data.task.title);
                                $('#task-' + id).find('.task-date1').html(data.date1);
                                $('#task-' + id).find('.task-date2').html(data.date2);
                                $('#task-' + id).find('.task-manager').html(data.user);
                                $('#task-' + id).find('.task-desc').html(data.task.description);

                                if(data.status_id){
                                    $('#task-' + id).find('.task-status button').html(data.status_id.name).css("background-color",data.status_id.color);
                                    $('#task-' + id).find('.status-task').css("background-color",data.status_id.color);
                                    $('#task-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                                }else{
                                    $('#task-' + id).find('.task-status button').html('В работе').css("background-color",'#3B79D6');
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
                if(desc.val() == '')
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
                            if(data.status == "success"){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Данные изменены!',
                                    showConfirmButton: false,
                                    timer: 700
                                });
                                console.log(data);
                                $('#meet-' + id).find('.meet-name').html(data.meet.title);
                                $('#meet-' + id).find('.meet-company').html(data.customer.company);
                                $('#meet-' + id).find('.meet-manager').html(data.user);
                                $('#meet-' + id).find('.meet-desc').html(data.meet.description);
                                $('#meet-' + id).find('.meet-date1').html(data.date1);
                                $('#meet-' + id).find('.meet-date2').html(data.date2);
                                $('#EditMeet-' + id).find('.modal-title').html(data.meet.title);

                                if(data.meet.active == 2){
                                    $('#meet-' + id).find('.meet-status button').html('Завершено').css("background-color",'#26DB38');
                                    $('#meet-' + id).find('.status-meet').css("background-color",'#26DB38');
                                    $('#meet-' + id).find('.change-color').attr('fill','#26DB38').css("color",'#26DB38');
                                }else if(data.status_id && data.meet.active == 1){
                                    $('#meet-' + id).find('.meet-status button').html(data.status_id.name).css("background-color",data.status_id.color);
                                    $('#meet-' + id).find('.status-meet').css("background-color",data.status_id.color);
                                    $('#meet-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                                }else{
                                    $('#meet-' + id).find('.meet-status button').html('В ожидании').css("background-color",'#EBDC60');
                                    $('#meet-' + id).find('.status-meet').css("background-color",'#C4C4C4');
                                    $('#meet-' + id).find('.change-color').attr('fill','#C4C4C4').css("color",'#C4C4C4');
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
                let id = $('#customer_name');
                let desc = $('#customer_desc');
                let date = $('#customer_date');
                if(desc.val().length < 20)
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
                        url: '{{ route('customerchange') }}',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id.val(),
                            "desc": desc.val(),
                            "date": date.val(),
                        },
                        success: data => {
                            $('#AddPotencial').modal('hide');
                            console.log(data);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Потенциальный клиент добавлен!',
                                showConfirmButton: false,
                                timer: 700
                            });
                            if (data.view) {
                                let result = $('#customers-scroll').prepend(data.view).show('slide', {direction: 'left'}, 400);
                                result.find('.customerDone').each((e,i) => {
                                    doneCustomer($(i));
                                });
                                result.find('.customerDelete').each((e,i) => {
                                    deleteCustomer($(i));
                                });
                            }
                            $('#customer_name').val('');
                            $('#customer_desc').val('');
                            $('#customer_date').val('');
                        },
                        error: data => {
                            console.log(data);
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
            {{--$('.waitCall').click(e => {--}}
            {{--    e.preventDefault();--}}
            {{--    let btn = $(e.currentTarget);--}}
            {{--    let id = $('#caller_id').val();--}}
            {{--    console.log(id);--}}
            {{--    $.ajax({--}}
            {{--        url: 'callw',--}}
            {{--        method: 'POST',--}}
            {{--        data: {--}}
            {{--            "_token": "{{ csrf_token() }}",--}}
            {{--            "id": id,--}}
            {{--        },--}}
            {{--        success: data => {--}}
            {{--            swal("Звонок добавлен в список на перезвон!","Отчет был отправлен","success");--}}
            {{--            $('#calledModal').modal('hide');--}}
            {{--            $('#call-' + id).hide(400);--}}
            {{--            console.log(data);--}}
            {{--        },--}}
            {{--        error: () => {--}}
            {{--            console.log(0);--}}
            {{--            swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");--}}
            {{--        }--}}
            {{--    })--}}
            {{--})--}}
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
