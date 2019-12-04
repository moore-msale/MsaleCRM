@extends('layouts.app')

@section('content')
    @include('_partials.header')
    <div class="mt-5 pt-4">
        <div class="mt-2 mx-lg-3 mx-0 py-2 d-flex justify-content-center">
            <p class="text-dark sf-bold mb-0 mr-2 w-25" style="font-size: 18px;font-weight: 600;">
                Клиенты
            </p>
            @if(auth()->user()->role=='admin')
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateClientAdmin"  style="text-decoration: underline;font-size:14px;">
                    добавить клиента
                </a>
            @else
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateClient"  style="text-decoration: underline;font-size:14px;">
                    добавить клиента
                </a>
            @endif
        </div>
    </div>
    <div>
        <div class="blog-scroll" id="customers-scroll">
            @include('tasks.list', ['customers3' => $customers])
        </div>
    </div>
    @if(auth()->user()->role=='admin')
        @include('modals.customers.create_client_admin')
    @else
        @include('modals.customers.create_client')
    @endif
@endsection
@push('scripts')
@if(auth()->user()->role =='admin')
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
                        $('#EditCustomerAdmin-' + id).find('.modal-title').html(data.customer.name);
                        $('#customer-' + id).find('.cust-name').html(data.customer.name);
                        $('#customer-' + id).find('.cust-company').html(data.customer.company);
                        $('#customer-' + id).find('.cust-date').html(data.task.deadline_date);
                        $('#customer-' + id).find('.cust-manager').html(data.user);
                        $('#history_block-' + id).html(data.html);
                        if (data.task.description.length > 25)
                            $('#customer-' + id).find('.cust-desc').html(data.task.description.substring(0,25) + '...');
                        else
                            $('#customer-' + id).find('.cust-desc').html(data.task.description);
                        if(data.status_id){
                            $('#customer-' + id).find('.cust-status button').html(data.status_id.name).css("background-color",data.status_id.color);
                        }else{
                            $('#customer-' + id).find('.cust-status button').html('В работе').css("background-color",'#3B79D6');
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
                $('#customer-' + id).hide();
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
@else
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
                url:'customer/'+id,
                method: 'PUT',
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
                        console.log(data);
                        $('#customer-' + id).find('.cust-name').html(data.customer.name);
                        $('#customer-' + id).find('.cust-company').html(data.customer.company);
                        $('#customer-' + id).find('.cust-desc').html(data.customer.description);
                        $('#customer-' + id).find('.cust-date').html(data.deadline_date);
                        $('#history_block-' + id).html(data.html);
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
@endif
@endpush
