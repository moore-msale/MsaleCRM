<div class="row py-2 task-point failtask-{{$task->id}}" id="failtask-{{$task->id}}" style="{{$task->chief != null ? 'border-left: 1px solid red;' : ''}}">
    <div class="col-2 d-flex align-items-center">
                    <span class="task-title task-name">
                        {{ $task->title }}
                    </span>
    </div>
    <div class="col-4 d-flex align-items-center">
                    <span class="task-desc task-name">
                        {{$task->description}}
                    </span>
    </div>
    <div class="col-2 d-flex align-items-center">
                    <span class="task-manager task-name">
                        {{ \App\User::find($task->user_id)->name }}
                    </span>
    </div>
    <div class="col-2 d-flex align-items-center">
                    <span class="task-date task-name">
                        {{ $task->deadline_date }}
                    </span>
    </div>
    <div class="col-2 text-center">
        <button class="btn py-2 px-3 task-name task-button text-white" style="background:#d60300; opacity: 1;" disabled>
            Просрочено
        </button>
    </div>
    <div class="col-3 d-flex align-items-center justify-content-center">
        <i class="far fa-times-circle fa-sm mr-3 ico-delete task-ico" data-toggle="modal" data-target="#DeleteTaskAdmin-{{$task->id}}" style="cursor:pointer;" title="Удалить задачу"></i>
        <i class="fas fa-pencil-alt fa-sm mr-3 ico-edit task-ico" data-toggle="modal" data-target="#EditTaskAdmin-{{ $task->id }}" style="cursor:pointer;" title="Изменить описание"></i>
    </div>
</div>

