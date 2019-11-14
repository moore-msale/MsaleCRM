<div class="modal fade" id="calledModal" tabindex="-1" role="dialog" aria-labelledby="calledModal"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-primary" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Статус звонка</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-phone fa-4x animated rotateIn"></i>
                    <div class="container-fluid pt-5">
                        <div class="row">
                            <div class="col-7 px-0">
                                    <input type="hidden" id="caller_id">
                                    <input type="hidden" id="caller_company">
                                    <input type="hidden" id="caller_phone">
                                <a type="button" class="btn btn-primary call_add py-2 w-100">Добавить в клиенты <i class="fas fa-check ml-1 text-white"></i></a>
                            </div>
                                <div class="col-1 d-lg-block d-none"></div>
                            <div class="col-7 px-0">
                                <a type="button" class="btn btn-danger deleteCall py-2 w-100">Удалить из списка <i class="fas fa-times ml-1 text-white"></i></a>
                            </div>
                            <div class="col-7 px-0">
                                <a type="button" class="btn btn-success waitCall py-2 w-100"> На перезвон <i class="fas fa-check ml-1 text-white"></i></a>
                            </div>
                            <div class="col-1 d-lg-block d-none"></div>
                            <div class="col-7 px-0">
                                <a type="button" class="btn btn-warning notCall py-2 w-100"> Не ответили<i class="fas fa-times ml-1 text-white"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        </div>
        <!--/.Content-->
    </div>
</div>