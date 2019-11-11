<div class="row py-2 task-point donemeet-{{$task->id}}" id="donemeet-{{$task->id}}" style="{{$task->chief != null ? 'border-left: 1px solid red;' : ''}}">
    <div class="col-2 d-flex align-items-center">
                    <span class="meet-title task-name">
                        {{ $task->title }}
                    </span>
    </div>
    <div class="col-2 d-flex align-items-center">
                    <span class="meet-company task-name">
                        {{ $task->taskable->customer->company }}
                    </span>
    </div>
    <div class="col-3 d-flex align-items-center">
                    <span class="meet-desc task-name">
                        {{$task->description}}
                    </span>
    </div>
    <div class="col-2 d-flex align-items-center">
                    <span class="meet-manager task-name">
                        {{ \App\User::find($task->user_id)->name }}
                    </span>
    </div>
    <div class="col-2 d-flex align-items-center">
                    <span class="meet-date task-name">
                        {{ $task->deadline_date }}
                    </span>
    </div>
    <div class="col-2 text-center">
            <button class="btn py-2 px-3 task-name task-button text-white" style="background:#3BD654; opacity: 1;" disabled>
                Выполнено
            </button>
    </div>
    <div class="col-2 d-flex align-items-center justify-content-center">
        <i class="far fa-times-circle fa-sm mr-3 ico-delete task-ico" data-toggle="modal" data-target="#DeleteMeetAdmin-{{$task->id}}" style="cursor:pointer;" title="Удалить встречу"></i>
        <i class="fas fa-pencil-alt fa-sm mr-3 ico-edit task-ico" data-toggle="modal" data-target="#EditMeetAdmin-{{ $task->id }}" style="cursor:pointer;" title="Изменить описание"></i>
    </div>
</div>

