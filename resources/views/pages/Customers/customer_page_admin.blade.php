@extends('layouts.app')
@push('styles')
    <style>
        body {
            background: #F5F6FA !important;
        }
    </style>
@endpush
@section('content')
    <?php
    $agent = New \Jenssegers\Agent\Agent();
    //    dd(session('timer'));
    ?>

    <div class="container-fluid py-5 px-3">
        <div class="menu-bar">
                <form class="row" action="{{ route('customer_filter')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="col-3">
                        <select name="manager" id="meetingname" class="browser-default custom-select border-0">
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
                    <div class="col-3">
                        <select name="status" id="meetingname" class="browser-default custom-select border-0">
                            @if(isset($status) && $status == 0)
                                <option value="0">Без статуса</option>
                            @else
                            <option value="{{isset($status) ? $status : null }}">{{ isset($status) ? \App\Status::find($status)->name : 'Все статусы'}}</option>
                                <option value="0">Без статуса</option>
                            @endif
                            @if(isset($status) )
                                <option value="{{ null }}">Все статусы</option>
                            @endif

                            @foreach(\App\Status::where('type','customer')->get() as $status1)
                                @if(isset($status) && $status1->id == $status)

                                    @continue
                                @endif
                                <option value="{{ $status1->id }}">{{ $status1->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <button class="new-button">
                            Применить
                        </button>
                    </div>
                </form>
            <div class="row pt-4">
                <div class="col-9">
                    <div class="search">
                        <input id="search" class="form-control" style="height:55px;" type="text" placeholder="Поиск по клиентам">
                        <div class="position-relative">
                            <div class="position-absolute search-result shadow bg-white" id="search-result" style="right: 0; top: 160%;width:100%; z-index:999;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-block pt-5" style="height:40vh;">
            <div class="row mb-3 py-2 sf-light" style="border-bottom:1px solid #DEDEDE; color:#a8a8a8;">
                <div class="col-2">
                    Имя
                </div>
                <div class="col-2">
                    Компания
                </div>
                <div class="col-3">
                    Описание
                </div>
                <div class="col-1">
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
                <div class="col-1">

                </div>
            </div>
            @foreach($customers as $customer)
            <div class="row py-2 sf-light" id="customer-{{$customer->id}}">
                <div class="col-2 cust-name" style="border-right:1px solid #dedede;">
                    {{ $customer->title }}
                </div>
                <div class="col-2 cust-company" style="border-right:1px solid #dedede;">
                    {{ $customer->taskable->company }}
                </div>
                <div class="col-3 cust-desc" style="border-right:1px solid #dedede;">
                    {{ str_limit($customer->description, $limit = 30, $end = '...') }}
                </div>
                <div class="col-1 cust-manager" style="border-right:1px solid #dedede;">
                    {{ \App\User::find($customer->user_id)->name }}
                </div>
                <div class="col-2 cust-date">
                    {{ \Carbon\Carbon::parse($customer->deadline_date)->format('M d - H:i') }}
                </div>
                <div class="col-2 cust-status">
                    @if(isset($customer->status))
                    <button style="width:100%; height:100%; color:white; background: {{ $customer->status->color }}; border-radius: 20px; border:0px;" disabled>
                        {{ $customer->status->name }}
                    </button>
                    @else
                        <button style="width:100%; height:100%; color:white; background: #3B79D6; border-radius: 20px; border:0px;" disabled>
                            В работе
                        </button>
                    @endif
                </div>
                <div class="col-2">
{{--                    @dd(\Carbon\Carbon::parse($customer->created_at))--}}
                    {{ \Carbon\Carbon::parse($customer->created_at)->format('M d - H:i') }}
                </div>
                    <div class="btn-group dropleft col-1">
                        <i class="fas fa-ellipsis-v w-100" data-toggle="dropdown" style="color:#C4C4C4; cursor: pointer;"></i>
                        <div class="dropdown-menu pl-2" style="border-radius: 0px; border:none;">
                            <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#EditCustomerAdmin-{{$customer->id}}" style="cursor:pointer;">изменить</p>
                            <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#DeleteCustomer-{{$customer->id}}" style="cursor:pointer;">удалить</p>

                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>


    @foreach(\App\Task::where('taskable_type','App\Customer')->get() as $customer)
        @include('modals.customers.edit_customer_admin')
        @include('modals.customers.delete_customer_admin')
    @endforeach
@endsection

@push('scripts')
    @foreach($customers as $customer)
        <script>
            $('#client_status-' + "{{$customer->id}}").on('change', function () {
                $('#client_desc-' + "{{$customer->id}}").val('');
            })
        </script>
    @endforeach
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
    <script>
            $('.editCustomer').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = btn.data('id');
                let date = $('#client_date-' + id);
                let name = $('#client_name-' + id);
                let company = $('#client_company-' + id);
                let phone = $('#client_phone-' + id);
                let social = $('#client_social-' + id);
                let manager = $('#client_manager-' + id);
                let status = $('#client_status-' + id);
                let desc = $('#client_desc-' + id);

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
                        url: 'EditCustomerAdmin',
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
                                $('#customer-' + id).find('.cust-desc').html(data.customer.description);
                                $('#customer-' + id).find('.cust-date').html(data.task.deadline_date);
                                $('#customer-' + id).find('.cust-manager').html(data.user);
                                $('#history_block-' + id).html(data.html);
                                console.log(data);
                            }else{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
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
        $('.deleteCustomer').click(e => {
            let btn = $(e.currentTarget);
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
                        position: 'center',
                        icon: 'success',
                        title: 'Клиент удален!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    $('#DeleteCustomer-' + id).modal('hide');
                    $('#customer-' + id).hide();
                },
                error: () => {
                    console.log(0);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Произошла ошибка!',
                        showConfirmButton: false,
                        timer: 700
                    });
                }
            })

        })
    </script>
@endpush
