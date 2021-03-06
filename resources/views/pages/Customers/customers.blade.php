@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }

    </style>
@endpush
@section('content')
    <?php
    $agent = New \Jenssegers\Agent\Agent();
    ?>

    <div class="container-fluid h-100">
        <div class="row h-100" style="padding-top: 2em;">
            <div class="px-0 h-auto col-lg-15 col-15">
                <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn light-green accent-4">
                    <p class="text-white sf-bold mb-0">
                        ВСЕ КЛИЕНТЫ
                    </p>
                </div>

                <div class="blog-scroll" id="customers-scroll">
                    <div class="container-fluid">
                    <div class="row">

                    @foreach($customers as $customer)
                            <div class="col-lg-3 col-15">
                            <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
                                 style="text-transform: uppercase;" id="customer-{{$customer->taskable->id}}">
                                @if($customer->status_id == 1)
                                    <div class="position-absolute"
                                         style="background-color: #64dd17; top:0%; left:0%; width:100%; height:2px; border-top-left-radius: 4px; border-top-right-radius: 4px;"></div>
                                @endif
                                {{--<div class="position-absolute bg-danger"--}}
                                {{--style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>--}}
                                    <div style="border-bottom:1px solid #DCDCDC;">
                                        <p class="deal-text sf-bold mb-2">
                                            <i class="far fa-user"></i><span class="pl-1 cust-name">
                                                     {{ $customer->taskable->name  ?? "No name" }}
                                                     </span>
                                        </p>
                                        <p class="deal-text sf-bold mb-2">
                                            <i class="far fa-building"></i><span class="pl-1 cust-company">
                                                        {{ $customer->taskable->company ?? "No company" }}
                                            </span>
                                        </p>
                                        <p class="deal-text sf-bold mb-2">
                                                 <i class="fas fa-phone"></i><span class="pl-1 cust-phone">{{ $customer->taskable->contacts ?? "No phone" }}</span>
                                            </p>
                                        <p class="deal-text sf-bold mb-2">
                                                    <i class="fab fa-twitter"></i><span class="pl-1 cust-social">{{ $customer->taskable->socials ?? "No socials" }}</span>
                                        </p>
                                    </div>
                                    @if(!$agent->isPhone())
                                <div class="toner">
                                    <div class="icon-panel mt-1 accordion md-accordion accordion-1" id="accordioncustomer{{$customer->id}}"
                                         role="tablist">
                                        <a data-toggle="collapse" href="#collapsedone{{$customer->id}}" aria-expanded="false"
                                           aria-controls="collapse25">
                                            <i class="far fa-times-circle fa-sm mr-1 ico-delete" title="Удалить задачу"></i>
                                        </a>
                                        <a data-toggle="collapse" href="#collapsedelete{{$customer->id}}" aria-expanded="false"
                                           aria-controls="collapse26">
                                            <i class="fas fa-pencil-alt fa-sm mr-1 ico-edit" title="Изменить описание"></i>
                                        </a>

                                        <div id="collapsedone{{$customer->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                             data-parent="#accordioncustomer{{$customer->id}}" style="border-bottom:1px solid #DCDCDC;">
                                            <form action="" class="text-right">
                                        <textarea placeholder="Введите причину удаления"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="details_delete_Customer"
                                                  style="outline: none;"></textarea>
                                                <a href="#collapsedone{{$customer->id}}" data-toggle="collapse" data-id="{{$customer->id}}"
                                                   class="bg-secondary px-2 py-1 border-0 confirm-but text-white btn deleteCustomer">
                                                    Удалить
                                                </a>
                                            </form>
                                        </div>
                                        <div id="collapsedelete{{$customer->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                             data-parent="#accordioncustomer{{$customer->id}}" style="border-bottom:1px solid #DCDCDC;">
                                            <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="details_update_Customer-{{$customer->taskable->id}}" style="outline: none;"></textarea>
                                                <div class="md-form">
                                                    <input type="text" id="customerchangename-{{$customer->taskable->id}}" name="name"
                                                           class="form-control sf-light textarea-font-size"
                                                           value="{{$customer->taskable->name}}">
                                                    <label for="customerchangename-{{$customer->taskable->id}}">ФИО</label>
                                                </div>
                                                <div class="md-form">
                                                    <input type="text" id="customerchangecompany-{{$customer->taskable->id}}" name="company"
                                                           class="form-control sf-light textarea-font-size"
                                                           value="{{$customer->taskable->company}}">
                                                    <label for="customerchangecompany-{{$customer->taskable->id}}">Компания</label>
                                                </div>
                                                <div class="md-form">
                                                    <input type="text" id="customerchangephone-{{$customer->taskable->id}}" name="phone"
                                                           class="form-control sf-light textarea-font-size"
                                                           value="{{$customer->taskable->contacts}}">
                                                    <label for="customerchangephone-{{$customer->taskable->id}}">Номер телефона</label>
                                                </div>
                                                <div class="md-form">
                                                    <input type="text" id="customerchangesocial-{{$customer->taskable->id}}" name="social"
                                                           class="form-control sf-light textarea-font-size"
                                                           value="{{$customer->taskable->contacts}}">
                                                    <label for="customerchangesocial-{{$customer->taskable->id}}">Соц. сети или сайт</label>
                                                </div>
                                                <a href="#collapsedelete{{$customer->id}}" data-toggle="collapse" data-id="{{$customer->taskable->id}}"
                                                   class="bg-warning px-2 py-1 border-0 confirm-but text-white btn editCustomer">
                                                    Изменить
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-dark mb-0">
                                            {{ $customer->description }}
                                        </p>
                                    </div>
                                </div>

                                        @endif
                            </div>
                    </div>
                    @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.customers.create_client')
    @include('modals.customers.add_customer')
@endsection