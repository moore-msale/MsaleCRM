<div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative potencial-show"
     style="text-transform: uppercase; cursor: pointer;" id="customer-{{$customer->taskable->id}}" >
    {{--<div class="position-absolute bg-danger"--}}
    {{--style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>--}}
    <div class="d-flex">
        <div data-toggle="modal" data-target="#EditCustomer-{{ $customer->id }}">
        <span class="deal-text sf-bold mb-0">
            <i class="far fa-user"></i><span class="pl-1 cust-name">
                {{ $customer->taskable->name  ?? "No name" }}
            </span>
        </span>
        <span class="deal-text sf-bold mb-0 ml-3">
            <i class="far fa-building"></i><span class="pl-1 cust-company">
                {{ $customer->taskable->company ?? "No company" }}
            </span>
        </span>
        </div>
        <div class="ml-auto">
                <i class="far fa-check-circle fa-sm mr-2 ico-done" data-toggle="modal" data-target="#DoneCustomer-{{ $customer->taskable->id }}"  title="Завершить задачу"></i>
                <i class="far fa-times-circle fa-sm mr-1 ico-delete" data-toggle="modal" data-target="#DeleteCustomer-{{ $customer->taskable->id }}" title="Удалить задачу"></i>
        </div>
    </div>
</div>

@include('modals.customers.edit_customer')
@include('modals.customers.done_customer')
@include('modals.customers.delete_customer')