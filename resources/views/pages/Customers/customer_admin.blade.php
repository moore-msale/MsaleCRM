@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }

    </style>
@endpush
@section('content')
    {{--@dd($customers)--}}
    <?php
    $agent = New \Jenssegers\Agent\Agent();
    ?>
    <div class="container-fluid p-5">
        <ul class="nav nav-tabs pb-5" id="myTab" role="tablist">
            <li class="nav-item report-tabs mr-4">
                <a class="nav-link report-tabs-link active" id="manage-customer" data-toggle="tab" href="#manage-customer-content" role="tab"
                   aria-controls="home"
                   aria-selected="true">Все Клиенты</a>
            </li>
            @foreach(\App\User::where('role','!=','admin')->get() as $user)
                <li class="nav-item report-tabs mr-4">
                    <a class="nav-link report-tabs-link" id="manage-customer-{{$user->id}}" data-toggle="tab" href="#manage-customer-content-{{$user->id}}" role="tab"
                       aria-controls="home"
                       aria-selected="true">{{ $user->name }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="manage-customer-content" role="tabpanel" aria-labelledby="home-tab">
                <div class="tab-content" id="myTabContent">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item col-15 pl-0 pr-3">
                            <ul class="nav nav-tabs pb-5" id="myTab" role="tablist">
                                <li class="nav-item report-tabs mr-4">
                                    <a class="nav-link report-tabs-link active" id="customer" data-toggle="tab" href="#customer-now" role="tab"
                                       aria-controls="home"
                                       aria-selected="true">Клиенты</a>
                                </li>
                                <li class="nav-item report-tabs mr-4">
                                    <a class="nav-link report-tabs-link" id="donecustomer" data-toggle="tab" href="#customer-done" role="tab"
                                       aria-controls="home"
                                       aria-selected="true">Потенциальные клиенты</a>
                                </li>
                                <li class="nav-item report-tabs mr-4">
                                    <a class="nav-link report-tabs-link" id="sadcustomer" data-toggle="tab" href="#customer-sad" role="tab"
                                       aria-controls="home"
                                       aria-selected="true">Неудачные клиенты</a>
                                </li>
                                <li class="nav-item report-tabs mr-4">
                                    <a class="nav-link report-tabs-link" id="readycustomer" data-toggle="tab" href="#customer-ready" role="tab"
                                       aria-controls="home"
                                       aria-selected="true">Завершенные клиенты</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="customer-now" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="tab-content" id="myTabContent">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item col-15 pl-0 pr-3 pb-5">
                                                <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                    Клиенты
                                                </p>
                                                {{--@dd($customers)--}}
                                                <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Имя
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p class="title-task">
                                                            Описание
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Менеджер
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Сроки
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Статус выполнения
                                                        </p>
                                                    </div>
                                                    <div class="col-3">

                                                    </div>
                                                </div>
                                                @foreach($customers as $customer)

                                                    @if($customer->status_id == 0 && \App\User::find($customer->user_id)->role != 'admin')
                                                        @include('pages.Customers.includes.customer')
                                                    @endif
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="customer-done" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="tab-content" id="myTabContent">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item col-15 pl-0 pr-3 pb-5">
                                                <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                    Потенциальные клиенты
                                                </p>
                                                <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Имя
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p class="title-task">
                                                            Описание
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Менеджер
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Сроки
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Статус выполнения
                                                        </p>
                                                    </div>
                                                    <div class="col-3">

                                                    </div>

                                                </div>
                                                <div class="content-tasker" id="content-tasker">
                                                    @foreach($customers as $customer)
                                                        @if($customer->status_id == 1 && \App\User::find($customer->user_id)->role != 'admin')
                                                            @include('pages.Customers.includes.done_customer')
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="customer-sad" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="tab-content" id="myTabContent">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item col-15 pl-0 pr-3 pb-5">
                                                <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                    Неудачные клиенты
                                                </p>
                                                <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Имя
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p class="title-task">
                                                            Описание
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Менеджер
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Сроки
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Статус выполнения
                                                        </p>
                                                    </div>
                                                    <div class="col-3">

                                                    </div>

                                                </div>
                                                <div class="content-tasker" id="content-tasker">
                                                    @foreach($customers as $customer)
                                                        @if($customer->status_id == 5 && \App\User::find($customer->user_id)->role != 'admin')
                                                            @include('pages.Customers.includes.lost_customer')
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="customer-ready" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="tab-content" id="myTabContent">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item col-15 pl-0 pr-3 pb-5">
                                                <p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                    Завершенные клиенты
                                                </p>
                                                <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Имя
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p class="title-task">
                                                            Описание
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Менеджер
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Сроки
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="title-task">
                                                            Статус выполнения
                                                        </p>
                                                    </div>
                                                    <div class="col-3">

                                                    </div>

                                                </div>
                                                <div class="content-tasker" id="content-tasker">
                                                    @foreach($customers as $customer)
                                                        @if($customer->status_id == 2 && \App\User::find($customer->user_id)->role != 'admin')
                                                            @include('pages.Customers.includes.ready_customer')
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


            @foreach(\App\User::where('role','!=','admin')->get() as $user)
                <div class="tab-pane fade" id="manage-customer-content-{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">
                    <div class="tab-content" id="myTabContent">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-15 pl-0 pr-3">
                                <ul class="nav nav-tabs pb-5" id="myTab" role="tablist">
                                    <li class="nav-item report-tabs mr-4">
                                        <a class="nav-link report-tabs-link active" id="customer-{{ $user->id }}" data-toggle="tab" href="#customer-now-{{$user->id}}" role="tab"
                                           aria-controls="home"
                                           aria-selected="true">Клиенты</a>
                                    </li>
                                    <li class="nav-item report-tabs mr-4">
                                        <a class="nav-link report-tabs-link" id="donecustomer-{{$user->id}}" data-toggle="tab" href="#customer-done-{{ $user->id }}" role="tab"
                                           aria-controls="home"
                                           aria-selected="true">Потенциальные клиенты</a>
                                    </li>
                                    <li class="nav-item report-tabs mr-4">
                                        <a class="nav-link report-tabs-link" id="sadcustomer-{{$user->id}}" data-toggle="tab" href="#customer-sad-{{ $user->id }}" role="tab"
                                           aria-controls="home"
                                           aria-selected="true">Неудачные клиенты</a>
                                    </li>
                                    <li class="nav-item report-tabs mr-4">
                                        <a class="nav-link report-tabs-link" id="readycustomer-{{$user->id}}" data-toggle="tab" href="#customer-ready-{{ $user->id }}" role="tab"
                                           aria-controls="home"
                                           aria-selected="true">Завершенные клиенты</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="customer-now-{{ $user->id }}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="tab-content" id="myTabContent">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item col-15 pl-0 pr-3">
                                                    <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                        Задачи
                                                    </p>
                                                    {{--@dd($customers)--}}
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Имя
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="title-task">
                                                                Описание
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Менеджер
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Сроки
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Статус выполнения
                                                            </p>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    @foreach($customers as $customer)
                                                        @if($customer->status_id == 0 && \App\User::find($customer->user_id)->role != 'admin' && $customer->user_id == $user->id)
                                                            @include('pages.Customers.includes.customer')
                                                        @endif
                                                    @endforeach

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="customer-done-{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="tab-content" id="myTabContent">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item col-15 pl-0 pr-3">
                                                    <p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                        Потенциальные клиенты
                                                    </p>
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Наименование задачи
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="title-task">
                                                                Описание
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Менеджер
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Сроки
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Статус выполнения
                                                            </p>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div class="content-tasker" id="content-tasker">
                                                        @foreach($customers as $customer)
                                                            @if($customer->status_id == 1 && \App\User::find($customer->user_id)->role != 'admin' && $customer->user_id == $user->id)
                                                                @include('pages.Customers.includes.done_customer')
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="customer-sad-{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="tab-content" id="myTabContent">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item col-15 pl-0 pr-3">
                                                    <p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                        Неудачные клиенты
                                                    </p>
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Имя
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="title-task">
                                                                Описание
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Менеджер
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Сроки
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Статус выполнения
                                                            </p>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div class="content-tasker" id="content-tasker">
                                                        @foreach($customers as $customer)
                                                            @if($customer->status_id == 5 && \App\User::find($customer->user_id)->role != 'admin' && $customer->user_id == $user->id)
                                                                @include('pages.Customers.includes.lost_customer')
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="customer-ready-{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="tab-content" id="myTabContent">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item col-15 pl-0 pr-3 pb-5">
                                                    <p class="h2 font-weight-bold py-5" style="font-size:23px; line-height: 27px; color:#545454">
                                                        Завершенные
                                                    </p>
                                                    <div class="row" style="border-bottom: 1px solid #DEDEDE;">
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Имя
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="title-task">
                                                                Описание
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Менеджер
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Сроки
                                                            </p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="title-task">
                                                                Статус выполнения
                                                            </p>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div class="content-tasker" id="content-tasker">
                                                        @foreach($customers as $customer)
                                                            @if($customer->status_id == 2 && \App\User::find($customer->user_id)->role != 'admin' && $customer->user_id == $user->id)
                                                                @include('pages.Customers.includes.ready_customer')
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
