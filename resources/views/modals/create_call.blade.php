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
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="md-form">
                            <input type="text" name="title" id="taskname" class="form-control">
                            <label for="form1">Заголовок</label>
                        </div>
                        <div class="md-form">
                            <textarea id="taskdescription" name="description" class="form-control md-textarea" rows="3"></textarea>
                            <label for="description">Описание</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="deadline_date" id="taskdate" class="form-control date-format">
                            <label for="date">Выберите срок</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-primary">Добавить <i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>


            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        </div>
        <!--/.Content-->
    </div>
</div>