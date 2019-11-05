<div class="row py-2 task-point" id="task-{{$task->id}}" style="{{$task->chief != null ? 'border-left: 1px solid red;' : ''}}">
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
                    <span class="task-name">
                        {{ \App\User::find($task->user_id)->name }}
                    </span>
    </div>
    <div class="col-2 d-flex align-items-center">
                    <span class="task-date task-name">
                        {{ $task->deadline_date }}
                    </span>
    </div>
    <div class="col-2 text-center">
        @if($task->status_id == 0)
            <button class="btn py-2 px-3 task-name task-button text-white" style="background:#A8A8A8; opacity: 1;" disabled>
                Не выполнено
            </button>
        @else
            <button class="btn py-2 px-3 task-name task-button text-white" style="background:#3BD654; opacity: 1;" disabled>
                Выполнено
            </button>
        @endif
    </div>
    <div class="col-3 d-flex align-items-center justify-content-center">
        <i class="far fa-check-circle fa-sm mr-3 ico-done task-ico" data-toggle="modal" data-target="#DoneTask-{{$task->id}}" style="cursor:pointer;" title="Завершить задачу"></i>
        <i class="far fa-times-circle fa-sm mr-3 ico-delete task-ico" data-toggle="modal" data-target="#DeleteTask-{{$task->id}}" style="cursor:pointer;" title="Удалить задачу"></i>
        <i class="fas fa-pencil-alt fa-sm mr-3 ico-edit task-ico" data-toggle="modal" data-target="#EditTask-{{ $task->id }}" style="cursor:pointer;" title="Изменить описание"></i>
    </div>
</div>
@include('modals.tasks.done_task')
@include('modals.tasks.delete_task')
@include('modals.tasks.edit_task')