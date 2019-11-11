<div class="modal fade" id="DoneMeetAdmin-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <!--Body-->
            <div class="modal-body">
                <p class="h3 text-center sf-medium py-5">
                    Завершить встречу?
                </p>
                <div class="row">
                    <div class="text-center" style="width:50%;">
                        <a type="button" class="btn btn-success doneMeet" data-id="{{ $task->id }}" data-parent="{{ $task->user_id }}" >Да<i class="fas fa-check ml-1 text-white" style="cursor:pointer;"></i></a>
                    </div>
                    <div class="text-center" style="width:50%;">
                        <a type="button" class="btn btn-success" data-dismiss="modal" >Нет<i class="fas fa-times ml-1 text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
