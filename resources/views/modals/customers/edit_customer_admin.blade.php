<?php
$agent = New \Jenssegers\Agent\Agent();
?>
@push('styles')
    <style>
        @media screen and (min-width: 992px)
        {
        .modal .modal-full-height .modal-dialog
        {
            width:700px;!important;
            max-width: 700px;!important;
        }
        }

    </style>
@endpush
<div class="modal fade right" id="EditCustomerAdmin-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right mx-0 mt-0" role="document" style="width:100%;!important;max-width: 700px;!important;">
        @if(!$agent->isPhone())
        <div class="modal-content px-2 w-50">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light " style="color:rgba(0,0,0,0.31);" id="myModalLabel">+ история</h4>
            </div>
            <div class="modal-body" style="height: 80vh; overflow-y: auto">
                <div id="history_block-{{ $customer->id }}">
                    @include('history.includes.history')
                </div>

            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
        @endif
        @if($agent->isPhone())
            <div class="modal-content px-2 w-100 mr-0" style="min-height: 550px; height: 100vh;">
         @else
            <div class="modal-content px-2 w-50 mr-0" style="min-height: 550px; height: 100vh;">
        @endif
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light overflow-hidden" id="myModalLabel">+ клиент</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="potentials" name="type">
                    <input type="text" name="name" id="client_name-{{ $customer->id }}" class="form-control sf-light border-0 " style="border-radius:0px; background: rgba(151,151,151,0.1);" value="{{$customer->taskable->name}}" placeholder="Введите ФИО">
                    <input type="text" id="client_phone-{{ $customer->id }}" name="phone" class="form-control sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $customer->taskable->contacts }}" placeholder="Введите контакты">
                    <input type="text" name="deadline_date" id="client_date-{{ $customer->id }}" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $customer->deadline_date }}" placeholder="Выберите дату">
                    <input type="text" id="client_company-{{ $customer->id }}" name="company" class="form-control sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $customer->taskable->company }}" placeholder="Введите компанию">
                    <input type="text" id="client_social-{{ $customer->id }}" name="social" class="form-control sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $customer->taskable->socials }}" placeholder="Введите соц.сеть или сайт">
                    <select class="browser-default custom-select border-0 mt-2" id="client_manager-{{ $customer->id }}" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="{{ \App\User::find($customer->user_id)['id'] }}">{{ \App\User::find($customer->user_id)['name'] }}</option>
                        @foreach(\App\User::all() as $user)
                            @if($user->id == \App\User::find($customer->user_id)['id'])
                                @continue
                            @endif
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @if($customer->active==2)
                        <input type="hidden" id="client_status-{{ $customer->id }}"  value="done">
                        <input type="text" name="status"   class="form-control sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" placeholder="Завершен" disabled>
                    @else
                        <select class="browser-default custom-select border-0 mt-2" id="client_status-{{ $customer->id }}" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                            @if($customer->active==2)
                                <option value="done">Завершен</option>
                            @elseif($customer->status_id == 0)
                                <option value="0">В работе</option>
                            @endif
                            @if(isset($customer->status))
                                    <option value="{{ \App\Status::find($customer->status_id)['id']}}">{{ \App\Status::find($customer->status_id)['name'] }}</option>
                                    <option value="0">В работе</option>
                            @endif
                            @foreach(\App\Status::where('type','customer')->get() as $stat)
                                @if(isset($customer->status) && $stat->id == \App\Status::find($customer->status_id)['id'])
                                    @continue
                                @endif
                                <option value="{{ $stat->id }}">{{ $stat->name }}</option>
                            @endforeach
                                <option value="done">Завершен</option>
                        </select>
                    @endif
                    <textarea id="client_desc-{{ $customer->id }}" name="description" class="form-control md-textarea sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" rows="3" placeholder="Введите описание">{{$customer->description}}</textarea>
                </form>
                <button type="button" class="w-100 sf-light editCustomer mt-5 space-button" data-id="{{$customer->id}}">Изменить</button>

            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
    </div>
</div>

