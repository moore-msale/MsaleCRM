<div class="row py-2 my-1 sf-light position-relative" id="meet-{{$task->id}}">
    <div class="col-2 meet-name-admin" style="border-right:1px solid #dedede;">
        {{ $task->title }}
    </div>
    <div class="col-4 meet-desc-admin" style="border-right:1px solid #dedede;">
        {{ str_limit($task->description, $limit = 25, $end = '...') }}
    </div>
    <div class="col-2 meet-manager-admin" style="border-right:1px solid #dedede;">
        {{ \App\User::find($task->user_id)->name }}
    </div>
    <div class="col-2 meet-deadline-admin">
        {{ \Carbon\Carbon::parse($task->deadline_date)->format('M d - H:i') }}
    </div>
    <div class="col-2 meet-status-admin">
        @if(isset($task->status))
            <button style="width:100%; height:100%; color:white; background: {{ $task->status->color }}; border-radius: 20px; border:0px;" disabled>
                {{ $task->status->name }}
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