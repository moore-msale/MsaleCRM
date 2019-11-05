<div class="modal fade" id="CallCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-primary" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Добавить звонок</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-phone fa-4x animated rotateIn"></i>
                    <p>"Excel - имя - 1 колонка, компания - 2 колонка, номер- 3 колонка!"</p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="calls" name="type">
                        <div class="md-form">
                            <input type="file" name="excel" id="excel" class="form-control">
                            <label for="excel">Excel</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-primary addCall">Добавить <i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>


            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        </div>
        <!--/.Content-->
    </div>
</div>
