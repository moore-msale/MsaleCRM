<div class="modal fade" id="DeleteMeetAdmin-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <!--Body-->
            <div class="modal-body">
                <div class="container-fluid">
                    <p class="h3 text-center sf-medium py-5">
                        Удалить встречу?
                    </p>
                    <div class="row">
                        <div class="text-center" style="width:50%;">
                            <a type="button" class="btn btn-danger deleteMeet" data-id="{{ $task->id}}" data-parent="{{ $task->user_id }}" >Да<i class="fas fa-check ml-1 text-white"></i></a>
                        </div>
                        <div class="text-center" style="width:50%;">
                            <a type="button" class="btn btn-danger" data-dismiss="modal" >Нет<i class="fas fa-times ml-1 text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
