{{--<div class="modal fade" id="MeetCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"--}}
     {{--aria-hidden="true">--}}
    {{--<div class="modal-dialog modal-notify modal-warning" role="document">--}}
        {{--<!--Content-->--}}
        {{--<div class="modal-content">--}}
            {{--<!--Header-->--}}
            {{--<div class="modal-header">--}}
                {{--<p class="heading lead">Добавить встречу</p>--}}

                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--<span aria-hidden="true" class="white-text">&times;</span>--}}
                {{--</button>--}}
            {{--</div>--}}

            {{--<!--Body-->--}}
            {{--<div class="modal-body">--}}
                {{--<div class="text-center">--}}
                    {{--<i class="fas fa-handshake fa-4x animated rotateIn"></i>--}}
                    {{--<form action="" method="POST" enctype="multipart/form-data">--}}
                        {{--@csrf--}}
                        {{--<input type="hidden" value="meetings" name="type">--}}
                        {{--<div class="md-form">--}}
                            {{--<select name="name" id="meetingname" class="browser-default custom-select">--}}
                                {{--<option value="{{ null }}">Выберите клиента...</option>--}}

                                {{--@foreach(\App\Task::where('user_id',auth()->id())->where('taskable_type','App\Customer')->get() as $customer)--}}
                                    {{--@if($customer->user_id == auth()->id())--}}
                                    {{--<option value="{{ $customer->taskable->id }}">{{ $customer->taskable->name }} - {{ $customer->taskable->company }}</option>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="md-form">--}}
                            {{--<textarea id="meetingdescription" name="description" class="form-control md-textarea" rows="3"></textarea>--}}
                            {{--<label for="description">Описание</label>--}}
                        {{--</div>--}}
                        {{--<div class="md-form">--}}
                            {{--<input type="text" name="deadline_date" id="meetingdate" class="form-control date-format">--}}
                            {{--<label for="meetingdate">Выберите срок</label>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                    {{--<a type="button" class="btn btn-warning addMeeting">Добавить <i class="fas fa-check ml-1 text-white"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}


            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        {{--</div>--}}
        {{--<!--/.Content-->--}}
    {{--</div>--}}
{{--</div>--}}




<div class="modal fade right" id="CreateMeet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal\App\Task::where('user_id',auth()->id())->where('taskable_type','App\Customer')->get() as $customer -->
    <div class="modal-dialog modal-full-height modal-right mx-0 mt-0" role="document" style="max-width:400px; width:100%;">
        <div class="modal-content px-2" style="min-height:550px;height: 100vh;">
            <div class="modal-header border-0">
                <h4 class="modal-title w-50 sf-light" id="myModalLabel">+ создать встречу</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="meetings" name="type">
                    <input type="hidden" id="meet_user" value="{{ auth()->id() }}" name="type">
                    <input type="text" name="deadline_date" id="meet_date" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" placeholder="Выберите дату">
                    <select class="browser-default custom-select border-0 mt-2 sf-light" id="meet_name" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="{{null}}">Выберите клиента...</option>
                        @foreach(\App\Task::where('user_id',auth()->id())->where('taskable_type','App\Customer')->get() as $tasks)
                            @if(empty(\App\Meeting::where('customer_id',$tasks->taskable_id)->first()))
                                <option class="customerid-{{$tasks->taskable['id']}}" value="{{ $tasks->taskable['id'] }}">{{ $tasks->taskable['name'] }} - {{$tasks->taskable['company']}}</option>
                            @endif
                        @endforeach
                    </select>
                    <textarea id="meet_desc" name="description" class="form-control md-textarea sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" rows="3" placeholder="Введите описание"></textarea>
                </form>
                @if(isset($customer))
                    <button type="button" class="w-100 sf-light createMeet mt-5 space-button" data-id="{{$customer->id}}">Создать</button>
                @else
                    <button type="button" class="w-100 sf-light createMeet mt-5 space-button" data-id="">Создать</button>
                @endif
            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
    </div>
</div>
