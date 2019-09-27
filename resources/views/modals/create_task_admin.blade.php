<div class="modal fade" id="TaskCreate_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Добавить задачу</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-tasks fa-4x mb-3 animated rotateIn"></i>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="tasks" name="type">
                        <div class="md-form">
                            <input type="text" name="title" id="taskname2" class="form-control">
                            <label for="form1">Заголовок</label>
                        </div>
                        <div class="md-form">
                            <textarea id="taskdescription2" name="description" class="form-control md-textarea" rows="3"></textarea>
                            <label for="description">Описание</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="deadline_date" id="taskdate2" class="form-control date-format">
                            <label for="date">Выберите срок</label>
                        </div>
                        <div class="md-form">
                            <select name="user_id" id="taskuser2" class="browser-default custom-select">
                                <option value="{{ null }}">Выберите менеджера...</option>

                                @foreach(\App\User::all()->except(1) as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <a type="button" class="btn btn-danger addTask2">Добавить <i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>


            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        </div>
        <!--/.Content-->
    </div>
</div>


