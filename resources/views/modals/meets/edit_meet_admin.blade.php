@push('styles')
    <style>
        @media screen and (min-width: 992px)
        {
        .modal .modal-full-height
        {
            width:360px;!important;
            max-width: 350px;!important;
        }
        }

    </style>
@endpush
<div class="modal fade right" id="EditMeetAdmin-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content px-2 w-100">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light overflow-hidden" id="myModalLabel">+{{ $task->title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" id="meet_name_admin-{{ $task->id }}" class="form-control sf-light border-0" style="border-radius:0px; background: rgba(151,151,151,0.1);" value="{{$task->title}}" placeholder="Компания">
                    <input type="text" name="deadline_date" id="meet_date_admin-{{ $task->id }}" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $task->deadline_date }}" placeholder="Дата выполнения">
                    <select class="browser-default custom-select border-0 mt-2" id="meet_manager_admin-{{ $task->id }}" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="{{ \App\User::find($task->user_id)->id }}">{{ \App\User::find($task->user_id)->name }}</option>
                        @foreach(\App\User::all() as $user)
                            @if($user->id == \App\User::find($task->user_id)->id)
                                @continue
                            @endif
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <select class="browser-default custom-select border-0 mt-2" id="meet_status_admin-{{ $task->id }}" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="0">В ожидании</option>
                        @foreach(\App\Status::where('type','meet')->get() as $stat)
                            @if($task->status_id == $stat->id)
                                <option value="{{ $stat->id }}" selected>{{ $stat->name }}</option>
                                @continue
                            @endif
                                <option value="{{ $stat->id }}" >{{ $stat->name }}</option>
                        @endforeach
                    </select>
                    <textarea id="meet_desc_admin-{{ $task->id }}" name="description" class="form-control md-textarea sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" rows="3" placeholder="Введите описание">{{$task->description}}</textarea>
                </form>
                <button type="button" class="w-100 sf-light editMeet mt-5 space-button" data-id="{{$task->id}}">Изменить</button>

            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
    </div>
</div>
