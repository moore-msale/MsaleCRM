<div class="modal fade right" id="search_customer-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content px-2">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light" id="myModalLabel">+{{ $task->title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="potentials" name="type">
                    <input type="text" name="name" id="task_name-{{ $task->id }}" class="form-control input-new" value="{{$task->title}}" placeholder="Введите имя">
                    <div class="md-form">
                        <input type="text" name="deadline_date" id="task_date-{{ $task->id }}" class="form-control date-format" value="{{ $task->deadline_date }}">
                        <label for="task_date-{{ $task->id }}">Дата выполнения</label>
                    </div>
                    <div class="md-form">
                        <textarea id="task_desc-{{ $task->id }}" name="description" class="form-control md-textarea" rows="3"> {{$task->description}}</textarea>
                        <label for="task_desc-{{ $task->id }}">Описание</label>
                    </div>
                    <div class="md-form">
                        <select name="name" id="task_manage-{{ $task->id }}" name="manager" class="browser-default custom-select">
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
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>