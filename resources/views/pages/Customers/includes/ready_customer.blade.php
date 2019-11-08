<div class="row py-2 task-point" id="readycustomer-{{$customer->id}}" style="{{$customer->chief != null ? 'border-left: 1px solid red;' : ''}}">
    <div class="col-2 d-flex align-items-center">
                    <span class="task-name">
                        {{ $customer->title }}
                    </span>
    </div>
    <div class="col-4 d-flex align-items-center">
                    <span class="task-name">
                        {{$customer->description}}
                    </span>
    </div>
    <div class="col-2 d-flex align-items-center">
                    <span class="task-name">
                        {{ \App\User::find($customer->user_id)->name }}
                    </span>
    </div>
    <div class="col-2 d-flex align-items-center">
                    <span class="task-name">
                        {{ $customer->deadline_date }}
                    </span>
    </div>
    <div class="col-2 text-center">
        <button class="btn py-2 px-3 task-name task-button text-white" style="background:#250054; opacity: 1;" disabled>
            Закрыт
        </button>
    </div>
    <div class="col-3 d-flex align-items-center justify-content-center">
        {{--<i class="far fa-check-circle fa-sm mr-3 ico-done task-ico" data-toggle="modal" data-target="#DoneCustomer-{{$customer->id}}" style="cursor:pointer;" title="Завершить клиента"></i>--}}
        <i class="far fa-times-circle fa-sm mr-3 ico-delete task-ico" data-toggle="modal" data-target="#DeleteCustomer-{{$customer->id}}" style="cursor:pointer;" title="Удалить клиента"></i>
        <i class="fas fa-pencil-alt fa-sm mr-3 ico-edit task-ico" data-toggle="modal" data-target="#EditCustomer-{{ $customer->id }}" style="cursor:pointer;" title="Изменить описание"></i>
    </div>
</div>
