<div class="modal fade" id="DoneTask-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Завершение задачи</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-user-friends fa-4x animated rotateIn"></i>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="md-form">
                            <input type="text" name="name" id="details_done_Task-{{$task->id}}" class="form-control">
                            <label for="details_done_Task-{{$task->id}}">Детали</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-success doneTask" data-id="{{ $task->id }}" >Завершить<i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
