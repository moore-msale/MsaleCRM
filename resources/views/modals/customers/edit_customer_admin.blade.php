{{--<div class="modal fade" id="EditCustomerAdmin-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"--}}
     {{--aria-hidden="true">--}}
    {{--<div class="modal-dialog modal-notify modal-success" role="document">--}}
        {{--<!--Content-->--}}
        {{--<div class="modal-content">--}}
            {{--<!--Header-->--}}
            {{--<div class="modal-header">--}}
                {{--<p class="heading lead">Изменение клиента</p>--}}

                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--<span aria-hidden="true" class="white-text">&times;</span>--}}
                {{--</button>--}}
            {{--</div>--}}

            {{--<!--Body-->--}}
            {{--<div class="modal-body">--}}
                {{--<div class="text-center">--}}
                    {{--<i class="fas fa-user-friends fa-4x animated rotateIn"></i>--}}
                    {{--<form action="" method="POST" enctype="multipart/form-data">--}}
                        {{--@csrf--}}
                        {{--<input type="hidden" value="potentials" name="type">--}}
                        {{--<div class="md-form">--}}
                            {{--<input type="text" name="name" id="client_name-{{ $customer->taskable->id }}" class="form-control" value="{{$customer->taskable->name}}">--}}
                            {{--<label for="client_name-{{ $customer->taskable->id }}">ФИО</label>--}}
                        {{--</div>--}}
                        {{--<div class="md-form">--}}
                            {{--<input type="text" id="client_phone-{{ $customer->taskable->id }}" name="phone" class="form-control" value="{{ $customer->taskable->contacts }}">--}}
                            {{--<label for="client_phone-{{ $customer->taskable->id }}">Номер телефона</label>--}}
                        {{--</div>--}}
                        {{--<div class="md-form">--}}
                            {{--<input type="text" name="deadline_date" id="client_date-{{ $customer->taskable->id }}" class="form-control date-format" value="{{ $customer->deadline_date }}">--}}
                            {{--<label for="client_date-{{ $customer->taskable->id }}">Дата выполнения</label>--}}
                        {{--</div>--}}
                        {{--<div class="md-form">--}}
                            {{--<input type="text" id="client_company-{{ $customer->taskable->id }}" name="company" class="form-control" value="{{ $customer->taskable->company }}">--}}
                            {{--<label for="client_company-{{ $customer->taskable->id }}">Компания</label>--}}
                        {{--</div>--}}
                        {{--<div class="md-form">--}}
                            {{--<input type="text" id="client_social-{{ $customer->taskable->id }}" name="social" class="form-control" value="{{ $customer->taskable->socials }}">--}}
                            {{--<label for="client_social-{{ $customer->taskable->id }}">Сайт или соц.сети</label>--}}
                        {{--</div>--}}
                        {{--<div class="md-form">--}}
                            {{--<textarea id="client_desc-{{ $customer->taskable->id }}" name="description" class="form-control md-textarea" rows="3"> {{$customer->description}}</textarea>--}}
                            {{--<label for="client_desc-{{ $customer->taskable->id }}">Описание</label>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                    {{--<a type="button" class="btn btn-success editCustomer2" data-id="{{ $customer->taskable->id }}" >Изменить<i class="fas fa-check ml-1 text-white"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="modal fade right" id="EditCustomerAdmin-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content px-2">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light" id="myModalLabel">+{{ $customer->title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="potentials" name="type">
                    <input type="text" name="name" id="client_name-{{ $customer->taskable->id }}" class="form-control sf-light border-0" style="border-radius:0px; background: rgba(151,151,151,0.1);" value="{{$customer->taskable->name}}" placeholder="Введите ФИО">
                    <input type="text" id="client_phone-{{ $customer->taskable->id }}" name="phone" class="form-control sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $customer->taskable->contacts }}" placeholder="Введите контакты">
                    <input type="text" name="deadline_date" id="client_date-{{ $customer->taskable->id }}" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $customer->deadline_date }}" placeholder="Выберите дату">
                    <input type="text" id="client_company-{{ $customer->taskable->id }}" name="company" class="form-control sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $customer->taskable->company }}" placeholder="Введите компанию">
                    <input type="text" id="client_social-{{ $customer->taskable->id }}" name="social" class="form-control sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $customer->taskable->socials }}" placeholder="Введите соц.сеть или сайт">
                    <select class="browser-default custom-select border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="{{ \App\User::find($customer->user_id)->id }}">{{ \App\User::find($customer->user_id)->name }}</option>
                        @foreach(\App\User::all() as $user)
                            @if($user->id == \App\User::find($customer->user_id)->id)
                                @continue
                            @endif
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <select class="browser-default custom-select border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        @if($customer->status_id == 0)
                            <option value="0">В работе</option>
                        @endif
                        @if(isset($customer->status))
                                <option value="{{ \App\Status::find($customer->status_id)->id }}">{{ \App\Status::find($customer->status_id)->name }}</option>
                                <option value="0">В работе</option>
                            @endif
                        @foreach(\App\Status::where('type','customer')->get() as $stat)
                            @if(isset($customer->status) && $stat->id == \App\Status::find($customer->status_id)->id)
                                @continue
                            @endif
                            <option value="{{ $stat->id }}">{{ $stat->name }}</option>
                        @endforeach
                    </select>
                    <textarea id="client_desc-{{ $customer->taskable->id }}" name="description" class="form-control md-textarea sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" rows="3"> {{$customer->description}}</textarea>
                </form>
                <button type="button" class="w-100 sf-light editCustomer mt-5" data-id="{{$customer->id}}" style="border:1px solid #000000; background: transparent; box-shadow: none; padding:10px 0px;">Изменить</button>

            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
    </div>
</div>
