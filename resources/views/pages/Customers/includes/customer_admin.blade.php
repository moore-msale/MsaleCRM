<div class="row py-2 my-1 sf-light position-relative" id="customer-{{$customer->id}}">
    @if(count($customer->taskable->histories))
        <div class="position-absolute" style="width:10px; height:10px; background-color: #772FD2; top:3%; right:0%; border-radius: 50%;"></div>
    @endif
    <div class="col-2 cust-name" style="border-right:1px solid #dedede;">
        {{ $customer->title }}
    </div>
    <div class="col-2 cust-company" style="border-right:1px solid #dedede;">
        {{ $customer->taskable->company }}
    </div>
    <div class="col-3 cust-desc" style="border-right:1px solid #dedede;">
        {{ str_limit($customer->description, $limit = 25, $end = '...') }}
    </div>
    <div class="col-1 cust-manager" style="border-right:1px solid #dedede;">
        {{ \App\User::find($customer->user_id)->name }}
    </div>
    <div class="col-2 cust-deadline">
        {{ \Carbon\Carbon::parse($customer->deadline_date)->format('M d - H:i') }}
    </div>
    <div class="col-2 cust-status">
        <button style="width:100%; height:100%; color:white;background: #3B79D6; border-radius: 20px; border:0px;" disabled>
            В работе
        </button>
    </div>
    <div class="col-2 cust-date-admin">
        {{ \Carbon\Carbon::parse($customer->created_at)->format('M d - H:i') }}
    </div>
    <div class="btn-group dropleft col-1">
        <i class="fas fa-ellipsis-v w-100" data-toggle="dropdown" style="color:#C4C4C4; cursor: pointer;"></i>
        <div class="dropdown-menu pl-2" style="border-radius: 0px; border:none;">
            <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#EditCustomerAdmin-{{$customer->id}}" style="cursor:pointer;">изменить</p>
            <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#DeleteCustomerAdmin-{{$customer->id}}" style="cursor:pointer;">неудачно</p>
        </div>
    </div>
</div>
@include('modals.customers.delete_customer_admin')
@include('modals.customers.edit_customer_admin')
