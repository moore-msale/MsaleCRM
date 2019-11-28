<div class="row py-2 my-1 sf-light position-relative" id="task-{{$task->id}}">
    <div class="col-2 task-name" style="border-right:1px solid #dedede;">
        {{ $task->title }}
    </div>
    <div class="col-4 task-desc" style="border-right:1px solid #dedede;">
        {{ str_limit($task->description, $limit = 25, $end = '...') }}
    </div>
    <div class="col-2 task-manager" style="border-right:1px solid #dedede;">
        {{ \App\User::find($task->user_id)->name }}
    </div>
    <div class="col-2 task-deadline">
        {{ \Carbon\Carbon::parse($task->deadline_date)->format('M d - H:i') }}
    </div>
    <div class="col-2 task-status">
        @if(isset($task->status))
            <button style="width:100%; height:100%; color:white; background: {{ $task->status->color }}; border-radius: 20px; border:0px;" disabled>
                {{ $task->status->name }}
            </button>
        @else
            <button style="width:100%; height:100%; color:white; background: #3B79D6; border-radius: 20px; border:0px;" disabled>
                В работе
            </button>
        @endif
    </div>
    <div class="col-2 task-date">
        {{ \Carbon\Carbon::parse($task->created_at)->format('M d - H:i') }}
    </div>
    <div class="btn-group dropleft col-1">
        <i class="fas fa-ellipsis-v w-100" data-toggle="dropdown" style="color:#C4C4C4; cursor: pointer;"></i>
        <div class="dropdown-menu pl-2" style="border-radius: 0px; border:none;">
            <p class="mb-0 drop-point sf-medium pl-2" data-toggle="modal" data-target="#EditTask-{{$task->id}}" style="cursor:pointer;">изменить</p>
        </div>
    </div>
</div>
@include('modals.tasks.delete_task')
@include('modals.tasks.edit_task')
