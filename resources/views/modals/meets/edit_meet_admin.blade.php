<?php
$meeting = App\Meeting::where('id',$task->taskable_id)->first();
?>
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
    <div class="modal-dialog modal-full-height modal-right mx-0 mt-0" role="document"  style="max-width: 400px;width: 100%;">
        <div class="modal-content px-2 w-100"  style="min-height: 550px;height: 100vh;">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light overflow-hidden" id="myModalLabel">+ встреча</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select class="browser-default custom-select border-0 mt-2" name="name" id="meet_name-{{ $task->id }}" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        @foreach(\App\Customer::all() as $customer)
                            @if($meeting['customer_id'] == $customer->id)
                                <option class="customerid-{{$customer->id }}" value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                                @continue
                            @endif
                            @if(empty(\App\Meeting::where('customer_id',$customer->id)->first()))
                                <option class="customerid-{{$customer->id }}" value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if(!$task->active)
                        <input type="text" name="deadline_date" id="meet_date-{{ $task->id }}" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);"  placeholder="Дата просрочена выберите новую">
                    @else
                        <input type="text" name="deadline_date" id="meet_date-{{ $task->id }}" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $task->deadline_date }}" placeholder="Дата выполнения">
                    @endif
                    <select class="browser-default custom-select border-0 mt-2" id="meet_manager-{{ $task->id }}" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="{{ \App\User::find($task->user_id)['id'] }}">{{ \App\User::find($task->user_id)['name'] }}</option>
                        @foreach(\App\User::all() as $user)
                            @if($user->id == \App\User::find($task->user_id)['id'])
                                @continue
                            @endif
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <select class="browser-default custom-select border-0 mt-2" id="meet_status-{{ $task->id }}" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="0">В ожидании</option>
                        @foreach(\App\Status::where('type','meet')->get() as $stat)
                            @if($task->status_id == $stat->id)
                                <option value="{{ $stat->id }}" selected>{{ $stat->name }}</option>
                                @continue
                            @endif
                                <option value="{{ $stat->id }}" >{{ $stat->name }}</option>
                        @endforeach
                    </select>
                    <textarea id="meet_desc-{{ $task->id }}" name="description" class="form-control md-textarea sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" rows="3" placeholder="Введите описание">{{$task->description}}</textarea>
                </form>
                <button type="button" class="w-100 sf-light editMeetAdmin mt-5 space-button" data-id="{{$task->id}}">Изменить</button>
            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
    </div>
</div>
