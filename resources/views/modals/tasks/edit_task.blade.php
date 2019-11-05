<div class="modal fade" id="EditTask-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Изменение задачи</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-tasks fa-4x animated rotateIn"></i>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="potentials" name="type">
                        <div class="md-form">
                            <input type="text" name="name" id="task_name-{{ $task->id }}" class="form-control" value="{{$task->title}}">
                            <label for="task_name-{{ $task->id }}">Название</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="deadline_date" id="task_date-{{ $task->id }}" class="form-control date-format" value="{{ $task->deadline_date }}">
                            <label for="task_date-{{ $task->id }}">Дата выполнения</label>
                        </div>
                        <div class="md-form">
                            <textarea id="task_desc-{{ $task->id }}" name="description" class="form-control md-textarea" rows="3"> {{$task->description}}</textarea>
                            <label for="task_desc-{{ $task->id }}">Описание</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-success editTask" data-id="{{ $task->id }}" >Изменить<i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
