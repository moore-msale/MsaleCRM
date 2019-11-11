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
    <div class="container-fluid">
        <div class="row pt-lg-4 pt-0">
            <div class="px-0 h-auto col-lg-3 col-15">
                <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center category-btn indigo accent-3">
                    <a href="/home" class="text-white sf-bold mb-0 mr-auto px-3 py-3">
                        ВСЕ ЗВОНКИ
                    </a>
                    <a href="/waitCall" class="text-white sf-bold mb-0 mx-auto d-md-none d-block bg-success px-3 py-3 mx-0">
                        На перезвон
                    </a>
                    <a href="/notCall" class="text-white sf-bold mb-0 ml-auto d-md-none d-block bg-danger px-3 py-3 mx-0">
                        Не ответившие
                    </a>
                </div>
                <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                     style=" box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                    <p class="mx-auto font-weight-bold mb-0" style="font-size: 20px; ">
                        На перезвон
                    </p>
                </div>
                <div class="blog-scroll" id="calls-scroll">
                    @include('tasks.list', ['calls3' => $calls])
                </div>
            </div>
        </div>
    </div>
    @include('modals.calls.called-modal')
    @include('modals.customers.add_customer')
    @include('modals.calls.add_1_call')
@endsection

@push('scripts')
    <script>
        function registerCallBtn(item) {
            item.click(function (e) {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = btn.data('id');
                let company = btn.data('parent');
                let phone = btn.data('parent2');
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
        $('.Call_1_add').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
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
                    swal("Номер добавлен!","Отчет был отправлен","success");
                    let result = $('#calls-scroll').prepend(data.view).show('slide', {direction: 'left'}, 400);
                    result.find('.call-btn').each((e, i) => {
                        registerCallBtn($(i));
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
        $('.waitCall').click(e => {
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
                    swal("Звонок добавлен в список на перезвон!","Отчет был отправлен","success");
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
@endpush
