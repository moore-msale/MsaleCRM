<div class="mt-2 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative potencial-show" id="meet-{{$task->id}}" >
    {{--<div class="position-absolute bg-danger"--}}
    {{--style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>--}}
    <div class="pb-1 position-relative" style="border-bottom:1px solid rgba(0,0,0,0.2);">
        <div class="font-weight-bold meet-company sf-medium"> {{ $task->taskable->customer['company'] }} </div>

        <div class="btn-group dropleft col-1 position-absolute" style="top:0%; right:-4%;">
            <i class="fas fa-ellipsis-v" data-toggle="dropdown" style="color:#C4C4C4; cursor: pointer;"></i>
            <div class="dropdown-menu pl-2 shadow" style="border-radius: 0px; border:none;">
                @if(auth()->user()->role=="admin")
                    <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#EditMeetAdmin-{{$task->id}}" style="cursor:pointer;">изменить</p>
                    <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#DeleteMeetAdmin-{{$task->id}}" style="cursor:pointer;">удалить</p>
                @else
                    <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#EditMeet-{{$task->id}}" style="cursor:pointer;">изменить</p>
                @endif
            </div>
        </div>
    </div>
    <div class="d-flex mt-2">
        <div class="deal-text sf-bold mb-0 d-flex align-items-start">
            <svg width="11" height="11" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="change-color" d="M8.4375 1.125H7.3125V0.5625C7.3125 0.225 7.0875 0 6.75 0H6.1875C5.85 0 5.625 0.225 5.625 0.5625V1.125H3.375V0.5625C3.375 0.225 3.15 0 2.8125 0H2.25C1.9125 0 1.6875 0.225 1.6875 0.5625V1.125H0.5625C0.225 1.125 0 1.35 0 1.6875V8.4375C0 8.775 0.225 9 0.5625 9H8.4375C8.775 9 9 8.775 9 8.4375V1.6875C9 1.35 8.775 1.125 8.4375 1.125ZM7.875 7.875H1.125V3.9375H7.875V7.875Z" fill="{{ isset($task->status) != null ? $task->status->color : '#C4C4C4'}}"/>
            </svg>
            <span class="pl-1 meet-date1 change-color" style="{{ isset($task->status) != null ? 'color:'.$task->status->color.';' : 'color:#C4C4C4;'}}">
                {{ \Carbon\Carbon::parse($task->deadline_date)->format('d M') }}
            </span>
        </div>
        <div class="deal-text sf-bold mb-0 d-flex align-items-start ml-2">
            <svg class="svg" width="13" height="13" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="change-color" d="M5.49771 0.916664C2.96542 0.916664 0.916672 2.96771 0.916672 5.5C0.916672 8.03229 2.96542 10.0833 5.49771 10.0833C8.03001 10.0833 10.0833 8.03229 10.0833 5.5C10.0833 2.96771 8.03001 0.916664 5.49771 0.916664ZM5.50001 9.16667C3.47417 9.16667 1.83334 7.52583 1.83334 5.5C1.83334 3.47416 3.47417 1.83333 5.50001 1.83333C7.52584 1.83333 9.16667 3.47416 9.16667 5.5C9.16667 7.52583 7.52584 9.16667 5.50001 9.16667ZM5.72917 3.20833H5.04167V5.95833L7.44563 7.40208L7.79167 6.83833L5.72917 5.61458V3.20833Z" fill="{{ isset($task->status) != null ? $task->status->color : '#C4C4C4'}}"/>
            </svg><span class="pl-1 meet-date2 change-color" style="{{ isset($task->status) != null ? 'color:'.$task->status->color.';' : 'color:#C4C4C4;'}}">
                {{ \Carbon\Carbon::parse($task->deadline_date)->format('H:i') }}
            </span>
        </div>
        <div class="deal-text sf-bold mb-0 d-flex align-items-start ml-2">
            <svg width="11" height="11" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.0625 8.11C9.06262 8.00945 9.03847 7.91037 8.99212 7.82115C8.94577 7.73193 8.87858 7.65521 8.79625 7.5975C7.66872 6.86731 6.34211 6.50563 5 6.5625C3.65789 6.50563 2.33128 6.86731 1.20375 7.5975C1.12142 7.65521 1.05423 7.73193 1.00788 7.82115C0.961528 7.91037 0.937385 8.00945 0.9375 8.11V9.6875H9.0625V8.11Z" stroke="#111111" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5 4.6875C6.20812 4.6875 7.1875 3.70812 7.1875 2.5C7.1875 1.29188 6.20812 0.3125 5 0.3125C3.79188 0.3125 2.8125 1.29188 2.8125 2.5C2.8125 3.70812 3.79188 4.6875 5 4.6875Z" stroke="#111111" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="pl-1 meet-name">
                {{ $task->taskable->customer['name'] }}
            </span>
        </div>
    </div>
    {{--<div class="ml-auto">--}}

    {{--<a class="customerDone">--}}
    {{--<i class="far fa-check-circle fa-sm mr-2 ico-done" data-toggle="modal" data-target="#DoneCustomer-{{ $customer->taskable->id }}"  title="Завершить задачу" onclick="doneCustomer()"></i>--}}
    {{--</a>--}}

    {{--<a class="customerDelete">--}}
    {{--<i class="far fa-times-circle fa-sm mr-1 ico-delete" data-toggle="modal" data-target="#DeleteCustomer-{{ $customer->taskable->id }}" title="Удалить задачу" onclick="deleteCustomer()"></i>--}}
    {{--</a>--}}

    {{--</div>--}}
    <div class="status-meet position-absolute h-100" style="width:3px; background-color: {{ isset($task->status) != null ? $task->status->color : '#C4C4C4'}}; top:0%; left:0%; "></div>
</div>
@if(auth()->user()->role=='admin')
    @include('modals.meets.delete_meet_admin')
    @include('modals.meets.edit_meet_admin')
@else
    @include('modals.meets.delete_meet_admin')
    @include('modals.meets.edit_meet')
@endif
