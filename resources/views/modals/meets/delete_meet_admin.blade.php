<div class="modal fade " id="DeleteMeetAdmin-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <p class="h3 sf-light pb-4 pt-2">
                        Удалить встречу?
                    </p>
                    <button type="button" class="sf-light deleteMeet mt-4 w-25 space-button" data-id="{{$task->id}}">Да</button>
                    <button type="button" class="sf-light mt-4 w-25 space-button" data-dismiss="modal" aria-label="Close">Нет</button>
                </div>
            </div>
        </div>
    </div>
</div>
