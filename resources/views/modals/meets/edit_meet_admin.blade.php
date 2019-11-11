<div class="modal fade" id="EditMeetAdmin-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Изменение встречи</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-handshake fa-4x animated rotateIn"></i>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="potentials" name="type">
                        <div class="md-form">
                            <input type="text" name="deadline_date" id="meet_date-{{ $task->id }}" class="form-control date-format" value="{{ $task->deadline_date }}">
                            <label for="meet_date-{{ $task->id }}">Дата выполнения</label>
                        </div>
                        <div class="md-form">
                            <textarea id="meet_desc-{{ $task->id }}" name="description" class="form-control md-textarea" rows="3"> {{$task->description}}</textarea>
                            <label for="meet_desc-{{ $task->id }}">Описание</label>
                        </div>
                        <div class="md-form">
                            <select name="name" id="meet_manage-{{ $task->id }}" name="manager" class="browser-default custom-select">
                                {{--                                <option value="{{ $task->user_id }}">{{ \App\User::find($task->user_id)->name }}</option>--}}
                                @foreach(\App\User::where('role','!=', 'admin')->get() as $user)
                                    @if($task->user_id == $user->id)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <a type="button" class="btn btn-success editMeet" data-id="{{ $task->id }}" data-parent="{{ $task->user_id }}" >Изменить<i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
